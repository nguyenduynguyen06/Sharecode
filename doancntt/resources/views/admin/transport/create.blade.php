@extends('admin.layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tạo mới vận chuyển</span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form class="form-valide-with-icon" action="{{ route('admin.transport.store') }}" method="POST"
                            novalidate="novalidate">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label class="text-label">Tỉnh/Thành Phố</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    </div>
                                    <select class="form-control" name="province">
                                        <option value="">Vui lòng chọn tỉnh/thành phố</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">
                                                {{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if (!empty($errors->first('province')))
                                    <div class="col-md-6" style="color:red; margin-bottom:12px;">
                                        {{ $errors->first('province') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="text-label">Phí vận chuyển</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="val-username1" name="price"
                                        placeholder="0" value="">
                                </div>
                                @if (!empty($errors->first('price')))
                                    <div class="col-md-6" style="color:red; margin-bottom:12px;">
                                        {{ $errors->first('price') }}</div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
