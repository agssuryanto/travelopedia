@extends('layouts.admin')
@section('content')

<div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">Province</h3>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a style="margin-left: 5%;" href="{{ route('province.create') }}" class="btn btn-primary"><i class="fe fe-settings"></i>&nbsp;Add Province</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                        <tr>
                          <th>No</th>
                          <th>Province Name</th>
                          <th>Province Logo</th>
                          <th>Status</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $roles = count($data['provinces']->province);
                        if ( count($data['provinces']->province) > 0 )
                        {
                          $i=0;
                          foreach ($data['provinces']->province as $key )
                          {
                            $i++;
                            $status = ( $key->status == "1" ) ? "Active" : "InActive";
                            print '
                              <tr>
                                <td>'.$i.'</td>
                                <td>'.$key->province_name.'</td>
                                <td><img src='.$key->province_logo.'></td>
                                <td class="text-nowrap">'.$status.'</td>
                                <td class="w-1">
                                  <a href='.config('app.url').'/admin/province/'.$key->id.'/edit class="icon"><i class="fe fe-edit"></i></a>
                                </td>
                                <td>
                                  <a href='.config('app.url').'/admin/province/'.$key->id.' class="icon"><i class="fe fe-trash"></i></a>
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
