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
                        {{ __('done') }}
                    </h5>
                    
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{route('diagnosis')}}" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Diagnosis" class="form-control-label">{{ __('Diagnosis') }}</label>
                                <div class="@error('Diagnosis')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{old('Diagnosis')}}" type="text" placeholder="Diagnosis" id="Diagnosis" name="Diagnosis">
                                        
                                </div>
                                @error('Diagnosis')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surgicalProcedure" class="form-control-label">{{ __('Surgical Procedure') }}</label>
                                <div class="@error('surgicalProcedure')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{old('surgicalProcedure')}}" type="text" placeholder="surgicalProcedure" id="surgicalProcedure" name="surgicalProcedure">
                                        
                                </div>
                                @error('surgicalProcedure')
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