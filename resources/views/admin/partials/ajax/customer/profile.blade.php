<table class="table table-bordered table-striped">
                        
    <tr>
        <td>Date Joined</td>
        <td colspan="3">{{$customer->created_at->format('d-m-Y')}}</td>
    </tr>
    <tr>
        <td>Company Name</td>
        <td colspan="3">{{$customer->company}}</td>
    </tr>
    <tr>
        <td>Practice Name</td>
        <td colspan="3">{{$customer->name}}</td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td colspan="3">{{$customer->contact}}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td colspan="3">{{$customer->email}}</td>
    </tr>
    
    <tr>
        <td>Number of Users</td>
        <td colspan="3">{{$customer->staffs->count()}}</td>
    </tr>
    <tr>
        <td>Number of Patients</td>
        <td colspan="3">{{$customer->patients->count()}}</td>
    </tr>
     <tr>
        <td colspan="4">Key Contacts</td>
        
    </tr>
     <tr>
        <td>Practice Manager</td>
        <td>{{ $practice_manager->name }}</td>
        <td>{{ $practice_manager->phone }}</td>
        <td>{{ $practice_manager->email }}</td>
    </tr>
    <tr>
        <td>Billing Contact</td>
        <td>{{ $billing_contact->name }}</td>
        <td>{{ $billing_contact->phone }}</td>
        <td>{{ $billing_contact->email }}</td>
    </tr>
   
        
    @foreach($others as $other)

        <tr>
            <td>{{$other->title}}</td>
            <td>{{ $other->name }}</td>
            <td>{{ $other->phone }}</td>
            <td>{{ $other->email }}</td>
        </tr>
    @endforeach
</table>
   
  

       
