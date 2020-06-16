<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deploy(Request $request)
    {
        $validated_data = $request->validate([
            'select_template' => ['required'],
            'select_template_servers' => ['required'],
        ]);

        $selected_template = $request->select_template;
        $selected_template_servers = $request->select_template_servers;
        $selected_template_servers_ip_addresses = "";

        foreach ($selected_template_servers as $selected_template_server)
        {
            $exploded_selected_template_server = explode(" ", $selected_template_server);
            $selected_template_servers_ip_addresses .= " " . $exploded_selected_template_server[1];
        }

        $command = "sudo bash ../bashscripts/deployTemplate.sh " . $selected_template . $selected_template_servers_ip_addresses;
        echo $command;
        // passthru($command);

        // return redirect()->back()->with("message", "Template deployed successfully!");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
