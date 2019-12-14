@extends('layouts.admin')
@section('content')

<div class="col-12">

                <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">User Posts</h3>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                        <tr>
                          <th>No</th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Uploader</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if ( count($data['popular']->locations) > 0 )
                        {
                          $i=0;
                          foreach ($data['popular']->locations as $key )
                          {
                            $i++;

                            print '
                              <tr>
                                <td>'.$i.'</td>
                                <td><a href='.$key->image.' target=_blank><img src='.$key->image.' width="100px"></a></td>
                                <td>'.$key->caption.'</td>';
                                $avatar = ( $key->avatar != '' ) ? $key->avatar : config('app.url').'/assets/images/user.png' ;
                            print '
                                <td><span class="avatar" style="background-image: url('.$avatar.')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$key->name.'</span></td>
                                <td class="w-1">
                                  <a href='.config('app.url').'/admin/posts/'.$key->post_id.'/edit class="icon"><i class="fe fe-edit"></i></a>
                                </td>
                                <td>
                                  <a href='.config('app.url').'/admin/posts/'.$key->post_id.' class="icon"><i class="fe fe-trash"></i></a>
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
