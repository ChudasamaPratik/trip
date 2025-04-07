@extends('backend.layout.main')
@section('title', 'Edit Requirement')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Requirement</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Your Requirement</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Requirement
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('requirement.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Requirement Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('requirement.update', $requirement->id) }}" enctype="multipart/form-data"
                id="auctionForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Origin <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('origin') is-invalid @enderror" name="origin" type="text"
                            placeholder="Enter origin location" value="{{ old('origin', $requirement->origin) }}" />
                        @error('origin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Destination <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('destination') is-invalid @enderror" name="destination"
                            type="text" placeholder="Enter destination location"
                            value="{{ old('destination', $requirement->destination) }}" />
                        @error('destination')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Number Of Days <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('days') is-invalid @enderror" name="days" type="number"
                            placeholder="Enter number of days" value="{{ old('days', $requirement->days) }}" />
                        @error('days')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Number Of Person <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('persons') is-invalid @enderror" name="persons" type="number"
                            placeholder="Enter number of persons" value="{{ old('persons', $requirement->person) }}" />
                        @error('persons')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Type of Accommodation <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('accommodation_type') is-invalid @enderror"
                            name="accommodation_type" type="text" placeholder="Enter accommodation type"
                            value="{{ old('accommodation_type', $requirement->accommodation) }}" />
                        @error('accommodation_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Breakfast <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="breakfastYes" name="breakfast" value="With Breakfast"
                                class="custom-control-input"
                                {{ old('breakfast', $requirement->breakfast) == 'With Breakfast' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="breakfastYes">With Breakfast</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="breakfastNo" name="breakfast" value="Without Breakfast"
                                class="custom-control-input"
                                {{ old('breakfast', $requirement->breakfast) == 'Without Breakfast' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="breakfastNo">Without Breakfast</label>
                        </div>
                        <div class="breakfast-error"></div>
                        @error('breakfast')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Price <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('price') is-invalid @enderror" name="price" type="number"
                            placeholder="Enter price" value="{{ old('price', $requirement->price) }}" />
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Tour <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('tour') is-invalid @enderror" name="tour" type="text"
                            placeholder="Enter tour details" value="{{ old('tour', $requirement->tour) }}" />
                        @error('tour')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Image</label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                id="aboutImage" name="image" accept="image/*">
                            <label class="custom-file-label" for="aboutImage">Choose new file</label>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer"
                            style="{{ $requirement->image ? 'display: block;' : 'display: none;' }}">
                            <img id="imagePreview"
                                src="{{ $requirement->image ? asset('storage/requirements/' . $requirement->image) : '#' }}"
                                alt="Requirement Preview" class="img-thumbnail" style="max-height: 300px;">
                        </div>
                        @if ($requirement->image)
                            <div class="mt-2">
                                <small class="text-muted">Current image: {{ $requirement->image }}</small>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Requirement
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Image preview functionality
            $("#aboutImage").change(function() {
                var preview = $("#imagePreview");
                var previewContainer = $("#imagePreviewContainer");
                var fileLabel = $(this).next('.custom-file-label');

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        previewContainer.show();
                        fileLabel.text($("#aboutImage")[0].files[0].name);
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    preview.attr('src',
                        '{{ $requirement->image ? asset('storage/requirements/' . $requirement->image) : '#' }}'
                    );
                    previewContainer.toggle(!!('{{ $requirement->image }}'));
                    fileLabel.text('Choose new file');
                }
            });

            // Form validation
            $("#auctionForm").validate({
                rules: {
                    origin: {
                        required: true,
                        minlength: 2
                    },
                    destination: {
                        required: true,
                        minlength: 2
                    },
                    days: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    persons: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    accommodation_type: {
                        required: true
                    },
                    breakfast: {
                        required: true
                    },
                    price: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    tour: {
                        required: true
                    },
                    image: {
                        extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    origin: {
                        required: "Please enter origin location",
                        minlength: "Origin must be at least 2 characters long"
                    },
                    destination: {
                        required: "Please enter destination location",
                        minlength: "Destination must be at least 2 characters long"
                    },
                    days: {
                        required: "Please enter number of days",
                        number: "Please enter a valid number",
                        min: "Number of days must be at least 1"
                    },
                    persons: {
                        required: "Please enter number of persons",
                        number: "Please enter a valid number",
                        min: "Number of persons must be at least 1"
                    },
                    accommodation_type: {
                        required: "Please enter accommodation type"
                    },
                    breakfast: {
                        required: "Please select breakfast option"
                    },
                    price: {
                        required: "Please enter a price",
                        number: "Please enter a valid number",
                        min: "Price must be 0 or greater"
                    },
                    tour: {
                        required: "Please enter tour details"
                    },
                    image: {
                        extension: "Please select a valid image file (jpg, jpeg, png, or gif)"
                    }
                },
                errorElement: "div",
                errorClass: "text-danger",
                errorPlacement: function(error, element) {
                    if (element.hasClass("custom-file-input")) {
                        error.insertAfter(element.parent());
                    } else if (element.attr("name") == "breakfast") {
                        error.appendTo($(".breakfast-error"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });

            // Change radio button color on click
            $("input[name='breakfast']").change(function() {
                if ($(this).is(":checked")) {
                    $("input[name='breakfast']").closest(".custom-control").addClass("text-success")
                        .removeClass("text-danger");
                    $("#auctionForm").validate().element("input[name='breakfast']");
                }
            });
            $.validator.addMethod("extension", function(value, element, param) {
                    param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|gif";
                    return this.optional(element) || value.match(new RegExp("\\.(" + param + ")$", "i"));
                },
                "Please select a file with a valid extension.");
        });
    </script>
@endpush
