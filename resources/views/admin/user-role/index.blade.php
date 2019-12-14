@extends('layouts.admin')
@section('content')

<div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">User Role</h3>
                    <a style="margin-left: 5%;" href="{{ route('user-role.create') }}" class="btn btn-primary"><i class="fe fe-settings"></i>&nbsp;Add Role</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                        <tr>
                        <th>No</th>
                          <th>Role Name</th>
                          <th>Display Name</th>
                          <th></th>
                          <th></th>
                        </tr>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $roles = count($data['roles']->role);
                        if ( count($data['roles']->role) > 0 )
                        {
                          $i=0;
                          foreach ($data['roles']->role as $key )
                          {
                            $i++;
                            print '
                              <tr>
                                <td>'.$i.'</td>
                                <td>'.$key->name.'</td>
                                <td class="text-nowrap">'.$key->display_name.'</td>
                                <td class="w-1">
                                  <a href='.config('app.url').'/admin/user-role/'.$key->id.'/edit class="icon"><i class="fe fe-edit"></i></a>
                                </td>
                                <td>
                                  <a href='.config('app.url').'/admin/user-role/'.$key->id.' class="icon"><i class="fe fe-trash"></i></a>
                                </td>
                              </tr>                            
                            ';
                          }
                        }
                      ?>             
                      </tbody>
                    </table>
                    <script>
                      require(['datatables', 'jquery'], function(datatable, $) {
                      	    $('.datatable').DataTable();
                      	  });
                    </script>
                  </div>
                </div>
              </div>

<!-- div class="my-3 my-md-5">
  <div class="container"  style="min-height: 375px;">
    <div class="page-header">

      <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">User Role</h3>
                    <a style="margin-left: 75%;" href="{{ route('user-role.create') }}" class="btn btn-primary"><i class="fe fe-settings"></i>&nbsp;Add Role</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-striped table-vcenter">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Role Name</th>
                          <th>Display Name</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $roles = count($data['roles']->role);
                        if ( count($data['roles']->role) > 0 )
                        {
                          $i=0;
                          foreach ($data['roles']->role as $key )
                          {
                            $i++;
                            print '
                              <tr>
                                <td>'.$i.'</td>
                                <td>'.$key->name.'</td>
                                <td class="text-nowrap">'.$key->display_name.'</td>
                                <td class="w-1">
                                  <a href='.config('app.url').'/admin/user-role/'.$key->id.'/edit class="icon"><i class="fe fe-edit"></i></a>
                                </td>
                                <td>
                                  <a href='.config('app.url').'/admin/user-role/'.$key->id.' class="icon"><i class="fe fe-trash"></i></a>
                                </td>
                              </tr>                            
                            ';
                          }
                        }
                      ?>                          
                      </tbody>
                    </table>
                  </div>
                </div>
              
    </div>
  </div>
</div -->


@endsection