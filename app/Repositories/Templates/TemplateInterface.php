<?php
namespace App\Repositories\Templates;

interface TemplateInterface {
    public function add($data);
    public function show();
    public function show_one($data);
    public function delete($id);

}
