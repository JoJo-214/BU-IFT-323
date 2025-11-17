<?php
namespace Controller;

use Model\Incident;
use Model\Student;

class IncidentController
{
    protected $model;
    protected $studentModel;
    public function __construct()
    {
        $this->model = new Incident();
        $this->studentModel = new Student();
    }

    public function index()
    {
        $incidents = $this->model->all();
        ob_start();
        include __DIR__ . '/../../templates/incident/list.php';
        $content = ob_get_clean();
        include __DIR__ . '/../../templates/layout.php';
    }

    public function create()
    {
        $students = $this->studentModel->all();
        $incident = null;
        ob_start();
        include __DIR__ . '/../../templates/incident/form.php';
        $content = ob_get_clean();
        include __DIR__ . '/../../templates/layout.php';
    }

    public function store()
    {
        $data = $_POST;
        $this->model->create($data);
        header('Location: ' . BASE_URL . '/?controller=incident&action=index');
        exit;
    }

    // edit/update/delete similar to StudentController omitted for brevity
}