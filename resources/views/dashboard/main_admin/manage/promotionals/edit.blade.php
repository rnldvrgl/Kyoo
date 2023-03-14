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
    <x-dashboard-sidebar name="{{ $role->name }}" />

    <!-- Main Content -->
    <main id="main" class="main">
        <!-- Content Title -->
        <div class="pagetitle">
            <h1>Promotional Materials</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Promotionals</li>
                    <li class="breadcrumb-item active">Manage Promotional Materials</li>
                </ol>
            </nav>
        </div>
        <!-- /Content Title -->
        <!-- Content Section -->
        <section class="section">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Promotional Videos</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addVideoModal">
                                    Upload Video
                                    <i class="fa-solid fa-upload ms-2"></i>
                                </button>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($videos as $video)
                                        <tr>
                                            <td>{{ $video->filename }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input is_active_switch" type="checkbox"
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
                                                <div class="d-flex flex-row justify-content-start">
                                                    <a href="#" class="btn btn-primary btn-rounded mx-auto"
                                                        data-video-filename="{{ $video->filename }}"
                                                        onclick="updateVideoPreview(this)">
                                                        <i class="fa-solid fa-circle-play"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-secondary mx-auto">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger mx-auto">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Video Preview</h5>
                            <div class="d-flex justify-content-center align-items-center">
                                <video id="previewVideo" style="object-fit: cover; max-width: 100%; max-height: 100%;"
                                    autoplay muted controls>
                                    <source src="" type="video/mp4">
                                </video>
                                <div id="noVideoSelected" class="text-center" style="display:none">No video selected
                                </div>
                                <div id="noVideoFound" class="text-center" style="display:none">No video with supported
                                    format and MIME type found</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Promotional Text</h4>
                        </div>
                        <div class="card-body">
                            {{-- {{ route('manage.promotionals.updatetext') }} --}}
                            <form action="#" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="text" class="form-label">Enter promotional
                                        text</label>
                                    <textarea class="form-control" id="text" name="text" rows="3">{{ $selected_text->text ?? '' }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Text</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Content Section -->

        <!-- Add Video Modal -->
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
    <!-- /Main Content -->
</x-layout>
