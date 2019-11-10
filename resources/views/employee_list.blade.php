@extends('includes.header')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
<div class="container-fluid px-xl-5">
          <section class="py-5">
            <div class="row">
              <div class="col-lg-12 mb-12">
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">Employee's List</h6>
                  </div>
                  <div class="card-body">                           
                    <table class="table table-striped card-text">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Profile Image</th>
                          <th>Known Technlogies</th>
                          <th>Joining Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php $i=1; ?>
                        @if($employee->isEmpty())
                        <td colspan="7" style="text-align:center">No data's are stored yet </td>
                        </tr>
                          @else
                          <tr>
                          @foreach($employee as $employees)
                          <th scope="row"><?=$i?></th>
                          <td>{{$employees->name}}</td>
                          <td>{{$employees->email}}</td>
                          <td><img width="100" src="{{ asset('uploads/'.$employees->profile_picture)}}"></td>
                          <td>{{$employees->known_technologies}}</td>
                          <td>{{$employees->joining_date}}</td>
                          <td><a href="{{url('edit',[$employees->id])}}">Edit</a>   <a href="{{url('delete',[$employees->id])}}" onclick="return confirm('Are You sure Want To Delete');">Delete</a> </td>
                        </tr>
                        <?php $i++; ?>
                          @endforeach
                          <tr>
                          <td colspan="7" style="text-align:center">{{ $employee->links() }}</td>
                          <tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
@endsection