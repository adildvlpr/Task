<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Todolist extends Component
{
    public $name = '';
    public $tasks = [];

    protected $listeners = ['deleteTask' => 'delete'];

    public function mount()
    {
        $this->tasks = session()->get('tasks', []);
    }

    public function add(){

        $name = trim($this->name);

        if ($name !== '' && !$this->taskExists($name)) {
            $this->tasks[] = ['name' => $name, 'status' => 'Pending'];
            session()->put('tasks', $this->tasks);
            $this->name = '';
        }

    }

    public function delete($taskName){

        $this->tasks = array_filter($this->tasks, function($task) use ($taskName) {
            return $task['name'] !== $taskName;
        });

        session()->put('tasks', array_values($this->tasks)); // Re-index the array
    }

    public function markAsCompleted($name)
    {
        $this->tasks = array_map(function($task) use ($name) {
            if ($task['name'] === $name) {
                $task['status'] = 'Completed';
            }
            return $task;
        }, $this->tasks);
        session()->put('tasks', $this->tasks);
    }

    private function taskExists($name)
    {
        foreach ($this->tasks as $task) {
            if ($task['name'] === $name) {
                return true;
            }
        }
        return false;
    }

    public function render()
    {
        return view('livewire.todolist');
    }
}
