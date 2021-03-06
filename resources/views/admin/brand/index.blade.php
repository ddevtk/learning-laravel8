@extends('admin.admin_master')
@section('admin')

<div class="py-12">
    <div class="container">

        <div class="row">

            <div class="col-md-8">
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card-header">All brand</div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Brand name</th>
                                <th scope="col">Brand image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php($i = 1) --}}
                            @foreach ($brands as $brand)
                            <tr>
                                <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                <td>{{ $brand->brand_name}}</td>
                                <td> <img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name }}"
                                        style="width: 50px; height= 40px;">
                                </td>
                                @if (!$brand->created_at)
                                <td><span class="text-danger">No date set</span></td>
                                @else
                                <td>{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</td>
                                @endif
                                <td>
                                    <a href="{{ url('/brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('/brand/delete/' . $brand->id) }}" class="btn btn-danger"
                                        onclick="return confirm('Are u sure delete this brand')">Move
                                        to trash</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $brands->links() }}
                </div>
            </div>

            <div class="col-md-4">

                <div class="card">

                    <div class="card-header">Add brand</div>
                    <div class="card-body">
                        <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Brand name</label>
                                <input name='brand_name' type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('brand_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                {{-- <label for="exampleInputEmail1" class="form-label">Brand image</label>
                                    <input name='brand_image' type="file" class="form-control" placeholder="Choose file"
                                        id="exampleInputEmail1" style="border: none"> --}}
                                <!-- actual upload which is hidden -->
                                <input type="file" id="actual-btn" hidden name="brand_image" />

                                <!-- our custom upload button -->
                                <label for="actual-btn" class="brand-label">Choose File</label>

                                <!-- name of file chosen -->
                                <span id="file-chosen">No file chosen</span>
                                @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
