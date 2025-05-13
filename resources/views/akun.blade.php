@extends('layout.sidebar')
@stack('styles')
  <style>

  </style>
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Akun<small></small></h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 label-align">Nama</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nama">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 label-align">Email</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 label-align">Level</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="level">
                                        <option value="">-- Pilih Level --</option>
                                        <option value="admin">Admin</option>
                                        <option value="marketing">Marketing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 offset-md-2">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div> <!-- x_content -->
                </div> <!-- x_panel -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- container -->
</div>
<!-- /page content -->
@endsection
