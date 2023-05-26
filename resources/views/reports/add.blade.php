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
                        {{ __('Deficiency Form') }}
                    </h5>
                    
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{route('report-save')}}" method="POST" role="form text-left">
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
                                <label for="MRN" class="form-control-label">{{ __('MRN') }}</label>
                                <div class="@error('MRN')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{old('MRN')}}" type="text" placeholder="MRN" id="MRN" name="MRN">
                                        
                                </div>
                                @error('MRN')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.department" class="form-control-label">{{ __('department') }}</label>
                                <div class="@error('user.department')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="role_id" name="department">
                                            @foreach ( $departments as $department)
                                                <option value="{{$department->id}}" >{{$department->name}}</option>
                                            @endforeach
                                
                                          </select>
                                        
                                </div>
                                @error('department')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="row align-items-center">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age" class="form-control-label">{{ __('age') }}</label>
                                <div class="@error('user.password') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="number" placeholder="00" id="age" name="age" value="{{ old('age')}} }}">
                                    
                                </div>
                                @error('age')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sex" class="form-control-label">{{ __('Sex') }}</label>
                                <div class="@error('sex')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="sex" name="sex">
                                                <option value="{{__('Male')}}" >{{__('Male')}}</option>
                                                <option value="{{__('Female')}}" >{{__('Female')}}</option>
                                          </select>
                                         
                                </div>
                                @error('sex')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="MRP" class="form-control-label">{{ __('MRP') }}</label>
                                <div class="@error('MRP')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{old('MRP')}}" type="text" placeholder="MRP" id="MRP" name="MRP">
                                        
                                </div>
                                @error('MRP')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                            </div>
                        </div>


                    </div>
                    <div class="row align-items-center my-2">

                    <div class="col-md-4">
                        <div class=" form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="blood"id="blood" checked="">
                                <label for="blood" class="form-control-label">{{ __('This patient has Blood Transfuion ?') }}</label>
                        </div>
                    </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type" class="form-control-label">{{ __('Type') }}</label>
                                <div class="@error('type')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="type" name="type">
                                            @foreach ( $types as $type)
                                                <option value="{{$type->id}}" >{{$type->name}}</option>
                                            @endforeach
                                          </select>
                                         
                                </div>
                                @error('type')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="admissionDate" class="form-control-label">{{ __('Date of Admission') }}</label>
                                <div class="@error('admissionDate')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{old('admissionDate')}}" type="date"  id="admissionDate" name="admissionDate">
                                        
                                </div>
                                @error('admissionDate')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dischargeDate" class="form-control-label">{{ __('Date of Discharge') }}</label>
                                <div class="@error('dischargeDate')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{old('dischargeDate')}}" type="date"  id="dischargeDate" name="dischargeDate">
                                        
                                </div>
                                @error('dischargeDate')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                            </div>
                        </div>


                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note" class="form-control-label">{{ __('Note') }}</label>
                                <div class="@error('note')border border-danger rounded-3 @enderror">
                                    <textarea  class="form-control" value="{{old('note')}}"   id="note" rows="4" cols="50" name="note"> </textarea>
                                </div>
                               
                            </div>
                            @error('note')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="stage"value="CDI"class="btn bg-gradient-primary btn-md mt-4 mb-4 mx-2">{{ 'CDI' }}</button>
                        <button type="submit" name="stage"value="IRR" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'IRR' }}</button>
                    </div>
                </form>

            </div>
        </div>
       
    </div>
    
</div>
@endsection