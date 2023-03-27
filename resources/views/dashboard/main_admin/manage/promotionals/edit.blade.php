{{-- Page Title --}}
@section('mytitle', 'Promotionals')

@php
    $details = $user_data['details'];
    $role = $user_data['role'];
    $login = $user_data['login'];
    $department = $user_data['department'];
    $profile_image = $details->profile_image;
@endphp

<x-layout :role='$role'>
    {{-- Dashboard Header Navbar --}}
    <x-dashboard-header :details="$details" :role="$role" />


    {{-- Dashboard Sidebar --}}
    <x-dashboard-sidebar name="{{ $role->name }}" :role="$role" />

    {{-- Main Content --}}
    <main id="main" class="main">
        {{-- Content Title --}}
        <div class="pagetitle">
            <h1>Promotional Materials</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage Promotional Materials</li>
                </ol>
            </nav>
        </div>
        {{-- /Content Title  --}}
        {{-- Content Section  --}}
        <section class="section">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div id="res" class="mt-3">
                                {{-- Append Success/Error Messages here --}}
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title py-0">Promotional Videos</h5>
                                {{--  Button trigger modal --}}
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addVideoModal">
                                    Upload Video
                                    <i class="fa-solid fa-upload ms-2"></i>
                                </button>
                            </div>
                            <div class="my-4">
                                @if (count($videos) > 0)
                                    <table class="table table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th style="width: 70%;">File Name</th>
                                                <th style="width: 20%;">Status</th>
                                                <th style="width: 10%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($videos as $video)
                                                <tr>
                                                    <td>{{ $video->filename }}</td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input is_active_switch"
                                                                type="checkbox"
                                                                id="is_active_switch_{{ $video->id }}"
                                                                data-video-id="{{ $video->id }}"
                                                                {{ $video->is_active ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="is_active_switch_{{ $video->id }}">
                                                                {{ $video->is_active ? 'Active' : 'Inactive' }}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-row justify-content-center gap-2">
                                                            {{-- Preview Video --}}
                                                            <button type="button" class="btn btn-primary"
                                                                data-video-filename="{{ $video->filename }}"
                                                                onclick="updateVideoPreview(this)">
                                                                <i class="fa-solid fa-circle-play"></i>
                                                            </button>

                                                            {{-- Delete/Remove Video --}}
                                                            <button type="button" class="btn btn-danger delete-video"
                                                                data-video-id="{{ $video->id }}">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="text-center py-4">
                                        <h4 class="text-danger fw-thin mb-3">No promotional videos have been uploaded.
                                        </h4>
                                        <p>To add a video, click the "Upload Video" button above.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div id="res-message" class="mt-3">
                                {{-- Append Success/Error Messages here --}}
                            </div>
                            <h5 class="card-title p-0 pb-3">Promotional Message</h5>
                            <form id="update-message-frm" action="{{ route('manage.promotionals.updatemessage') }}"
                                method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="text" class="form-label">Enter promotional message:</label>
                                    <textarea class="form-control" id="text" name="text" rows="3" required
                                        style="min-height: 150px; max-height: 250px; height: 150px;">{{ $texts[0]->text ?? '' }}</textarea>
                                    <div class="invalid-feedback">
                                        Please enter a promotional message.
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="btn-save-message" type="submit" class="btn btn-primary">
                                        Save Promotional Message <i class="fa-solid fa-floppy-disk ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Video Preview</h5>
                            <div class="d-flex justify-content-center align-items-center flex-grow-1">
                                <video id="previewVideo"
                                    style="object-fit: cover; max-width: 100%; min-height: 600px; max-height: 600px;"
                                    autoplay muted controls>
                                    <source src="" type="video/mp4">
                                </video>
                                <div id="noVideoSelected" class="text-center" style="display:none">
                                    <h3 class="fw-semibold text-kyoored mt-3">No video selected.</h3>
                                    <p class="text-muted mt-3">Click the preview button in the table to play.</p>
                                </div>
                                <div id="noVideoFound" class="text-center" style="display:none">
                                    <h3 class="fw-semibold text-kyoored mt-3">No video with supported</h3>
                                    <p class="text-muted mt-3">format and MIME type found</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /Content Section --}}

        {{-- Add Video Modal --}}
        <div class="modal fade" id="addVideoModal" tabindex="-1" aria-labelledby="addVideoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVideoModalLabel">Upload Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="res-modal">
                            {{-- Append Success/Error Messages here --}}
                        </div>
                        <form id="add-video-frm" action="{{ route('manage.promotionals.addvideo') }}" method="POST"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="video" class="form-label">Select video file</label>
                                <input type="file" class="form-control" id="video" name="video"
                                    accept="video/*" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success" id="btn-save-video">
                                    Upload
                                    <i class="fa-solid fa-upload ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var previewVideo = $("#previewVideo");
                var noVideoSelected = $("#noVideoSelected");
                var noVideoFound = $("#noVideoFound");

                // Hide the video element if there is no source
                if (!previewVideo.attr("src")) {
                    previewVideo.hide();
                    noVideoFound.hide();
                    noVideoSelected.show();
                } else {
                    previewVideo.show();
                    noVideoFound.hide();
                    noVideoSelected.hide();
                }

                // Video Preview
                function updateVideoPreview(button) {
                    var videoFilename = button.getAttribute('data-video-filename');
                    if (!videoFilename) {
                        $("#previewVideo").attr("src", "").hide();
                        $("#noVideoSelected").show();
                        $("#noVideoFound").hide();
                        return;
                    }
                    var videoUrl = "{{ Storage::url('public/promotional_videos/') }}" + videoFilename;
                    if (videoUrl.indexOf(".mp4") == -1) {
                        $("#previewVideo").attr("src", "").hide();
                        $("#noVideoSelected").hide();
                        $("#noVideoFound").show();
                        return;
                    }
                    $("#previewVideo").attr("src", videoUrl).show();
                    $("#noVideoSelected").hide();
                    $("#noVideoFound").hide();
                }

                $(".preview-video").click(function() {
                    updateVideoPreview(this);
                    $("#noVideoSelected").hide();
                });
            });

            // Video status change using axios
            $(document).on('change', '.is_active_switch', function() {
                let statusLabel = $(this).siblings('label');
                if ($(this).is(':checked')) {
                    statusLabel.text('Active');
                } else {
                    statusLabel.text('Inactive');
                }

                var video_id = $(this).data('video-id');
                var is_active = $(this).prop('checked');

                axios.put('{{ route('manage.promotionals.setactivevideo') }}', {
                        video_id: video_id,
                        is_active: is_active,
                        _token: '{{ csrf_token() }}'
                    })
                    .then(function(response) {
                        console.log(response);
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });

            // Delete video jquery confirm
            $(".delete-video").click(function() {
                var videoId = $(this).data("video-id");

                $.confirm({
                    type: "red",
                    title: "Confirm Deletion",
                    icon: "fa-solid fa-trash-can",
                    content: "Are you sure you want to delete this video?",
                    theme: "Modern",
                    draggable: false,
                    typeAnimated: true,
                    buttons: {
                        confirm: function() {
                            // Send AJAX request to delete video
                            $.ajax({
                                url: "{{ route('manage.promotionals.deletevideo', ['id' => ':id']) }}"
                                    .replace(':id', videoId),
                                type: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                },
                                success: function(response) {
                                    // Handle success response
                                    console.log(response);

                                    let success = '<div class="alert alert-success">' +
                                        response.message +
                                        '</div>';

                                    // Display success message
                                    $('#res').html(success);

                                    // Remove success message after 5 seconds
                                    setTimeout(function() {
                                        $('.alert-success').remove();
                                    }, 3000);

                                    // Reload the page after 1 second
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                },
                                error: function(xhr) {
                                    // Handle error response
                                    console.log("Failed to delete video.");

                                    let failed = '<div class="alert alert-danger">' +
                                        xhr.responseJSON.message +
                                        '</div>';

                                    // Display failed message
                                    $('#res').html(failed);

                                    // Remove failed message after 5 seconds
                                    setTimeout(function() {
                                        $('.alert-danger').remove();
                                    }, 3000);
                                },
                            });
                        },
                        cancel: function() {},
                    },
                });
            });

            // Video Preview
            function updateVideoPreview(button) {
                var videoFilename = button.getAttribute('data-video-filename');
                if (!videoFilename) {
                    $("#previewVideo").attr("src", "").hide();
                    $("#noVideoSelected").show();
                    return;
                }
                var videoUrl = "{{ Storage::url('public/promotional_videos/') }}" + videoFilename;
                if (videoUrl.indexOf(".mp4") == -1) {
                    $("#previewVideo").attr("src", "").hide();
                    $("#noVideoSelected").hide();
                    $("#noVideoFound").show();
                    return;
                }
                $("#previewVideo").attr("src", videoUrl).show();
                $("#noVideoSelected").hide();
                $("#noVideoFound").hide();
            }
        </script>

    </main>
    {{-- /Main Content  --}}
</x-layout>
