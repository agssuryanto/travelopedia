@extends('layouts.admin')
@section('content')

<div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">User Management</h3>
                    <a style="margin-left: 5%;" href="{{ route('user-management.create') }}" class="btn btn-primary"><i class="fe fe-settings"></i>&nbsp;Add User</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Role</th>
                            <th>Avatar</th>
                            <th>Status</th>
                            <th class="no-sort"></th>
                            <th class="no-sort"></th>
                            <th class="no-sort"></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if ( count($data['users']->users) > 0 )
                        {
                          $i=0;
                          foreach ($data['users']->users as $key )
                          {
                            $i++;
                            $avatar = ( $key->avatar != '' ) ? $key->avatar : config('app.url').'/assets/images/user.png' ;
                            print '
                              <tr>
                                <td>'.$i.'</td>
                                <td>'.$key->name.'</td>
                                <td class="text-nowrap">'.$key->email.'</td>
                                <td class="text-nowrap">'.$key->phone_no.'</td>
                                <td class="text-nowrap">'.$key->display_name.'</td>
                                <td class="text-nowrap">
                                <span class="avatar" style="background-image: url('.$avatar.')"></span>
                                </td>
                                <td class="text-nowrap">';
                                $sel = ( $key->status == "1" && $key->deleted == "0") ? "Active" : "InActive";
                                if ( $key->deleted == "1") {
                                    $sel .= " ( deleted )";
                                }
                                echo $sel;
                            print '
                                </td>
                                <td class="w-1">
                                  <a href='.config('app.url').'/admin/user-management/'.$key->id.'/edit class="icon"><i class="fe fe-edit"></i></a>
                                </td>
                                <td>
                                  <a href='.config('app.url').'/admin/user-management/'.$key->id.' class="icon"><i class="fe fe-trash"></i></a>
                                </td>
                                <td>
                                  <a href='.config('app.url').'/admin/changepassword/'.$key->id.'/edit class="icon">Reset Password</a>
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

@endsection
