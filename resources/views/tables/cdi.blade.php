@extends('layouts.user_type.auth')

@section('content')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">CDI</h5>
                            
                        </div>
                        <div class="ms-md-3 pe-md-3 d-flex align-items-center">
                            <form action="{{route('searchCdi')}}" method="post">
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
                                        MRP
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        TYPE
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        CHANGE TYPE
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        UPDATED AT
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        STATUS
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        LAST UPDATE
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
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
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->mrp}}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->type_name}}</p>
                                </td>
                                <div class="dropdown">
                                <td class="text-center">
                                       
                                            <a href="#" class="btn bg-gradient-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                              Change types
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                                @foreach ($types as $type)
                                                <li>
                                                    <a class="dropdown-item" href="{{route('updateType',["report_id"=>$irr->id,"type"=>$type->id])}}">
                                                        {{$type->name}}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                         
                                </td>
                            </div>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->updated_at}}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->status}}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{$irr->userName}}</p>
                                </td>
                              
                                <td class="text-center">
                                    <span>
                                    <a href="{{route('coding',['id'=>$irr->id])}}" type="button" class="btn bg-gradient-primary">coding</a>
                                    </span>
                                    <span>
                                        <a href="{{route('coding-irr',['id'=>$irr->id])}}" type="button" class="btn bg-gradient-secondary">irr</a>
                                    </span>
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
