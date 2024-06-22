<div>
    <div class="container mt-5">
        <h2 class="mb-4">To-Do List</h2>
        <form id="todoForm" wire:submit.prevent="add">
          <div class="form-row">
            <div class="col-8">
              <input type="text" class="form-control" wire:model="name" id="todoInput" placeholder="Enter a new task">
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Add Task</button>
            </div>
          </div>
        </form>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task['name'] }}</td>
                        <td> {{ $task['status'] }}</td> <!-- Assuming a default status of 'Pending' -->
                        <td>
                            @if ($task['status'] === 'Pending')
                            <button wire:click="markAsCompleted('{{ $task['name'] }}')" class="btn btn-success btn-sm">Mark as Completed</button>
                        @endif

                            <button onclick="confirmDeletion('{{ $task['name'] }}')"  class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>

</div>
<script>
    function confirmDeletion(name) {
        if (confirm('Are you sure you want to delete this task?')) {
            Livewire.emit('deleteTask', name);
        }
    }
</script>
