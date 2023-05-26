@extends('layouts.user_type.auth')

@section('content')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">ESR</h5>
                        </div>
                        <div class="ms-md-3 pe-md-3 d-flex align-items-center">
                            <form action="{{route('searchEsr')}}" method="post">
                                @csrf
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Type here..." name="search">
                            </div>
                            </form>
                            </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                     
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                       MRN
                                    </th>
                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Department
                                    </th>
                                   
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        TYPE
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Diagnosis
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Surgical Procedure
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date Of Discharge
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        LAST UPDATE
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($irr_data as $irr )
                            <tr>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->mrn}}</p>
                                </td>
                                
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->department}}</p>
                                </td>
                              
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->type_name}}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->diagnosis}}</p>
                                   
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->SurgicalProcedure}}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->dateofdischarge}}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->userName}}</p>
                                </td>
                              
                              
                            </tr> 
                            @endforeach
                                

                               
                            </tbody>
                        </table>
                        {{$irr_data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
