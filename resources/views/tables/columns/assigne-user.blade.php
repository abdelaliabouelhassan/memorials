<div>

    {{ $getState() ? 
        \App\Models\User::where('id',$getState())->first()->name : 'Not Assigned' }}
</div>
