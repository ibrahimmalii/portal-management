@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if($edit)
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp

                            @foreach($dataTypeRows as $row)
                                <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = $row->details->display ?? NULL;
                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                @endif

                                <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $row->slugify }}

                                    @if($row->getTranslatedAttribute('display_name') == 'Company Id')
                                        <label class="control-label" for="name">Main Company Name</label>
                                    @elseif($row->getTranslatedAttribute('display_name') == 'Sub Company Id')
                                        <label class="control-label" for="name">Sub Company Name</label>
                                    @elseif($row->getTranslatedAttribute('display_name') == 'User Id')
                                        <label class="control-label" for="name">User Name</label>
                                    @elseif($row->getTranslatedAttribute('display_name') == 'Product Id')
                                        <label class="control-label" for="name">Product Name</label>
                                    @else
                                    <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @endif

                                    @include('voyager::multilingual.input-hidden-bread-edit-add')


                                    @if ($add && isset($row->details->view_add))
                                    @include($row->details->view_add, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'view' => 'add', 'options' => $row->details])
                                    @elseif ($edit && isset($row->details->view_edit))
                                    @include($row->details->view_edit, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'view' => 'edit', 'options' => $row->details])
                                    @elseif (isset($row->details->view))
                                    @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                                    @elseif ($row->type == 'relationship')
                                    @include('voyager::formfields.relationship', ['options' => $row->details])
                                    @else
                                        @if($row->field == 'company_id')
                                            <div class="form-group">
                                                <select class="form-control" name="company_id">
                                                    @foreach('App\Models\Company'::all() as $company)
                                                        <option value="{{ $company->id }}"@if(isset($dataTypeContent->company_id) && $dataTypeContent->company_id == $company->id) selected="selected"@endif>{{ $company->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @elseif($row->field == 'product_id')
                                            <div class="form-group">
                                                <select class="form-control" name="product_id">
                                                    @foreach('App\Models\Product'::all() as $product)
                                                        <option value="{{ $product->id }}"@if(isset($dataTypeContent->product_id) && $dataTypeContent->product_id == $product->id) selected="selected"@endif>{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @elseif($row->field == 'user_id')
                                            <div class="form-group">
                                                <select class="form-control" name="user_id">
                                                    {{-- GEt users have the same company_id when change company_id select --}}
                                                    @foreach('App\Models\User'::where('role_id', 2)->orWhere('role_id', 3)->get() as $user)
                                                        <option value="{{ $user->id }}"@if(isset($dataTypeContent->user_id) && $dataTypeContent->user_id == $user->id) selected="selected"@endif>{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @elseif($row->field == 'sub_company_id')
                                            <div class="form-group">
                                                <select class="form-control" name="sub_company_id">
                                                    <option value="{{null}}">Select Sub Company</option>
                                                    @foreach('App\Models\SubCompany'::all() as $sub_company)
                                                        <option value="{{ $sub_company->id }}"@if(isset($dataTypeContent->sub_company_id) && $dataTypeContent->sub_company_id == $sub_company->id) selected="selected"@endif>{{ $sub_company->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @elseif($row->field == 'amount')
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="amount" placeholder="{{ $row->getTranslatedAttribute('display_name') }}" value="{{ old($row->field, $dataTypeContent->{$row->field}) }}">
                                            </div>
                                        @elseif($row->field == 'expired_at')
                                            <div class="form-group">
                                                <input type="date" class="form-control" name="expired_at" value="{{ $dataTypeContent->expired_at }}">
                                            </div>
                                        @elseif($row->field == 'is_fully_paid')
                                            <div class="form-group">
                                                <select class="form-control" name="is_fully_paid">
                                                    <option value="0" @if(isset($dataTypeContent->is_fully_paid) && $dataTypeContent->is_fully_paid == 0) selected="selected" @endif>No</option>
                                                    <option value="1" @if(isset($dataTypeContent->is_fully_paid) && $dataTypeContent->is_fully_paid == 1) selected="selected" @endif>Yes</option>
                                                </select>
                                            </div>
                                        @elseif($row->field == 'total_amount' || $row->field == 'remaining_amount')
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="{{ $row->field }}" placeholder="{{ $row->getTranslatedAttribute('display_name') }}" value="{{ old($row->field, $dataTypeContent->{$row->field}) ?? 0 }}">
                                            </div>
                                        @else
                                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                        @endif
                                    @endif

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                    @if ($errors->has($row->field))
                                        @foreach ($errors->get($row->field) as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <div style="display:none">
                        <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
                        <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();

        });
    </script>
@stop
