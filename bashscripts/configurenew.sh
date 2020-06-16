#!/bin/bash
#This bash file adds new servers if they are accessible. It also adds entry in /etc/hosts


echo "ran" > /tmp/test.log

#storing logs
echo `date` "configurenew.sh called" >> ../../iptables/time_logs.txt;
if [[ -f ../../iptables/msg.txt ]]; then
	rm ../../iptables/msg.txt;
fi;

server_name=$1;
ip_address=$2;

permanent_msg="echo 'Adding Permanent Access Rules' > ../../iptables/msg.txt";
$permanent_msg
my_ip=`curl ifconfig.me`;

#check if accessible
echo "checking if accessible";
timeout 10s ssh -o "StrictHostKeyChecking no" root@$ip_address -q exit > ../../bashscripts/result.txt;

#check if no error occurs
stat=$?;
if (( $stat == 0 )); then
	echo "no error";
	#adding entry in iptables/allservers.txt
	echo "$server_name|$ip_address" >> ../../iptables/allservers.txt;
	#writing 0 so that frontend can detect server added successfully
	echo 0 > ../../bashscripts/status.txt;
	chmod 777 ../../bashscripts/status.txt;

timeout 60s ssh -o "StrictHostKeyChecking no" root@$ip_address << EOF > ../../iptables/msg.txt
echo "Adding Permanent Access Rules"
iptables -I INPUT -p tcp -s $my_ip -j ACCEPT -m comment --comment "ip.Allow IPTablesManager";
iptables -I OUTPUT -p tcp -s $ip_address -d $my_ip -j ACCEPT -m comment --comment "ip.Allow IPTablesManager";
iptables -A INPUT -i lo -j ACCEPT -m comment --comment "ip.Allow loopback";
echo "Adding Special Rules";
iptables -A INPUT -m conntrack --ctstate ESTABLISHED,RELATED -j ACCEPT -m comment --comment "ip.Allow Related Traffic";
iptables -A INPUT -j DROP -m comment --comment "ip.Drop Irrelevant traffic";
EOF

timeout 60s ssh -o "StrictHostKeyChecking no" root@$ip_address << "EOF" >> ../../iptables/msg.txt
echo iptables-persistent iptables-persistent/autosave_v4 boolean true | sudo debconf-set-selections
echo iptables-persistent iptables-persistent/autosave_v6 boolean true | sudo debconf-set-selections
apt-get update && apt-get -y install netfilter-persistent iptables-persistent
if [[ ! -d "/etc/iptables" ]]; then
mkdir -p /etc/iptables;
fi;
iptables-save > /etc/iptables/rules.v4
ip6tables-save >/etc/iptables/rules.v6
systemctl enable netfilter-persistent.service
EOF


echo "Fetching IPTables" >> ../../iptables/msg.txt;
`sudo bash ../../bashscripts/fetchiptables.sh "$server_name" >> ../../iptables/updaterulelogs.txt`
	echo "Sending IP to Port Scanner" >> ../../iptables/msg.txt;
	#sending allserver file to ossec for port scanning
	# timeout 20s scp -o "StrictHostKeyChecking no" ../../iptables/allservers.txt root@178.62.191.109:/root/port_scanner
echo "END" >> ../../iptables/msg.txt;
	
else
	echo "cannot ssh"
	echo  $stat > ../../bashscripts/status.txt;
	chmod 777 ../../bashscripts/status.txt;
fi;
