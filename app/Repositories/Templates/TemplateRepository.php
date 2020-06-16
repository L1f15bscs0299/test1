<?php
namespace App\Repositories\Templates;
use App\Template;

class TemplateRepository implements TemplateInterface
{
	public function add($data){
		$template = new Template();
		$template->name = $data;
		return $template->save();
	}

	public function show(){
		return Template::where('is_delete', 0)->get();
	}

	public function show_one($data){
		return Template::where('id', $data['id'])->update(['name' => $data['new_name']]);
	}

	public function delete($data){
		return Template::where('id', $data)->update(['is_delete' => 1]);
	}
}