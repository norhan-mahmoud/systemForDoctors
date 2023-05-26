@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-5 mt-n10">
           
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ __('irr note') }}
                    </h5>
                    
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{route('irr')}}" method="get" role="form text-left">
                    @csrf
             
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="note" class="form-control-label">{{ __('note') }}</label>
                                <div class="@error('Diagnosis')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{old('note')}}" type="text" placeholder="note" id="note" name="note" required>
                                        
                                </div>
                                @error('note')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                            </div>
                        </div>
                       
                        
                        
                    </div>
                   
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="stage"value="CDI"class="btn bg-gradient-primary btn-md mt-4 mb-4 mx-2">{{ 'Submit' }}</button>
                    </div>
                </form>

            </div>
        </div>
       
    </div>
    
</div>
@endsection