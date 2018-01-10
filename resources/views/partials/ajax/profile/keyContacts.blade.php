 
@php
    $otherKey = 'otherkey'.$i;
@endphp

    <input id="" type="hidden" name="keycontacts[others][{{$otherKey}}][keyid]" placeholder="Title" value='{{$other->id}}' required="required" class="form-control keyUpdate ">
    <div for="" class="col-md-3">
        <input id="" type="text" name="keycontacts[others][{{$otherKey}}][title]" placeholder="Title" value='{{$other->title}}' required="required" class="form-control keyUpdate">
    </div> 
    <div class="col-md-3 ">
        <input id="" type="text" name="keycontacts[others][{{$otherKey}}][name]" placeholder="Name" value='{{$other->name}}' required="required" class="form-control keyUpdate">
    </div> 
    <div class="col-md-3 ">
        <input id="" type="text" name="keycontacts[others][{{$otherKey}}][phone]" placeholder="Number" value='{{$other->phone}}' required="required" class="form-control keyUpdate">
    </div> 
    <div class="col-md-3 ">
        <input id="" type="email" name="keycontacts[others][{{$otherKey}}][email]" placeholder="email" value='{{$other->email}}' required="required" class="form-control keyUpdate">
    </div>

@php
    $i++;
@endphp
