@extends('layouts.main')
@section('title',$file['name'])
@section('content')
    @include('breadcrumb')
    <div class="card border-light mb-3">
        <div class="card-header">
            {{ $file['name'] }}
        </div>
        <div class="card-body">
            <div class="text-center"><a href="{{ route('origin.view',$file['id']) }}" data-fancybox="image-list"><img
                        src="{{ $file['thumb'] }}" alt="{{ $file['name'] }}" class="img-fluid"></a></div>
            <br>
            <div class="text-center">
                <a href="{{ $file['path'] }}" class="btn btn-success"><i class="fa fa-download"></i> 下载</a> &nbsp;&nbsp;
                <a href="{{ route('view',$file['id']) }}" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i>
                    查看原图</a>
            </div>
            <hr>
            <label class="control-label">引用链接</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" id="link1" class="form-control" aria-label="Amount (to the nearest dollar)"
                           value="{{ route('origin.view',$file['id']) }}">
                    <div class="input-group-append">
                        <a href="javascript:void(0)" style="text-decoration: none" data-toggle="tooltip"
                           data-placement="right" data-clipboard-target="#link1" class="clipboard"><span
                                class="input-group-text">复制</span></a>
                    </div>
                </div>
            </div>
            <label class="control-label">Markdown链接</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" id="link2" class="form-control" aria-label="Amount (to the nearest dollar)"
                           value="![]({{ route('origin.view',$file['id']) }})">
                    <div class="input-group-append">
                        <a href="javascript:void(0)" style="text-decoration: none" data-toggle="tooltip"
                           data-placement="right" data-clipboard-target="#link2" class="clipboard"><span
                                class="input-group-text">复制</span></a>
                    </div>
                </div>
            </div>
            <label class="control-label">HTML链接</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" id="link3" class="form-control" aria-label="Amount (to the nearest dollar)"
                           value="<img src='{{ route('origin.view',$file['id']) }}' />">
                    <div class="input-group-append">
                        <a href="javascript:void(0)" style="text-decoration: none" data-toggle="tooltip"
                           data-placement="right" data-clipboard-target="#link3" class="clipboard"><span
                                class="input-group-text">复制</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
