<div class="modal fade" id="profile">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 25px; border: none; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
            <div class="modal-header" style="background: linear-gradient(135deg, rgba(220, 20, 60, 0.1) 0%, rgba(255, 255, 255, 0) 100%); border-bottom: 2px solid rgba(220, 20, 60, 0.2); border-radius: 25px 25px 0 0;">
                <h3 class="modal-title" style="color: #dc143c; font-weight: 700; font-size: 1.8rem;">
                    <i class="fa-solid fa-user-edit me-2"></i>
                    Edit Profile
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('my_page.update_profile') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="modal-body" style="padding: 30px;">
                    <div class="text-center mb-4">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset("storage/avatar/".Auth::user()->avatar) }}" alt="avatar" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #dc143c; box-shadow: 0 5px 20px rgba(220, 20, 60, 0.3);"/>
                        @else
                            <div style="width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, rgba(220, 20, 60, 0.1) 0%, rgba(220, 20, 60, 0.05) 100%); border: 4px solid #dc143c; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fa-solid fa-user" style="font-size: 4rem; color: #dc143c;"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="avatar_image" class="form-label fw-bold">
                            <i class="fa-solid fa-image me-2"></i>Profile Picture
                        </label>
                        <input type="file" name="avatar_image" id="avatar_image" class="form-control" style="border-radius: 12px; border: 2px solid #e0e0e0; padding: 12px;" aria-describedby="avatar_image_info">
                        <div class="form-text" id="avatar_image_info" style="margin-top: 8px;">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Acceptable formats: jpeg, jpg, png, gif only | Maximum file size: 1024KB
                        </div>
                        <p class="text-danger fw-bold mt-2" id="alert_avatar_image"></p>
                    </div>

                    <div class="form-check mb-4" style="padding: 15px; background: rgba(220, 20, 60, 0.05); border-radius: 12px;">
                        <input type="checkbox" name="remove_avatar_image" class="form-check-input" id="remove_avatar_image" style="cursor: pointer;">
                        <label for="remove_avatar_image" class="form-check-label fw-bold" style="cursor: pointer;">
                            Remove current profile picture
                        </label>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label fw-bold">
                                <i class="fa-solid fa-user me-2"></i>First Name
                            </label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ Auth::user()->first_name }}" style="border-radius: 12px; border: 2px solid #e0e0e0; padding: 12px;">
                            <p class="text-danger fw-bold mt-2" id="alert_first_name"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label fw-bold">
                                <i class="fa-solid fa-user me-2"></i>Last Name
                            </label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ Auth::user()->last_name }}" style="border-radius: 12px; border: 2px solid #e0e0e0; padding: 12px;">
                            <p class="text-danger fw-bold mt-2" id="alert_last_name"></p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="border-top: 2px solid rgba(220, 20, 60, 0.2); padding: 20px 30px; border-radius: 0 0 25px 25px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 12px; padding: 10px 25px;">
                        <i class="fa-solid fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn" id="btn_update" style="background: linear-gradient(135deg, #dc143c 0%, #b71c1c 100%); color: white; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none;">
                        <i class="fa-solid fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    const submit = document.querySelector('#btn_update');
    submit.addEventListener('click', (event) => {
        event.preventDefault();

        const avatar_image = document.querySelector('#avatar_image');
        const first_name = document.querySelector('#first_name');
        const last_name = document.querySelector('#last_name');

        const alert_avatar_image = document.querySelector('#alert_avatar_image');
        const alert_first_name = document.querySelector('#alert_first_name');
        const alert_last_name = document.querySelector('#alert_last_name');

        let error = false;
        alert_last_name.textContent = '';
        alert_first_name.textContent = '';
        alert_last_name.textContent = '';

        if (avatar_image.files[0]) {
            const avatar_image_size = avatar_image.files[0].size;
            const avatar_image_type = avatar_image.files[0].type;

            if (avatar_image_size > 1024000) {
                alert_avatar_image.textContent = 'Maximum file size is 1024KB.';
                error = true;
            }
            if (avatar_image_type != 'image/jpeg' && avatar_image_type != 'image/jpg' && avatar_image_type != 'image/png' && avatar_image_type != 'image/gif') {
                alert_avatar_image.textContent = 'Acceptable formats: jpeg, jpg, png, gif only.';
                error = true;
            }
        }

        if (first_name.value == '') {
            alert_first_name.textContent = 'First name is required.';
            error = true;
        }
        if (first_name.value.length > 255) {
            alert_first_name.textContent = 'First name must be 255 characters or less.';
            error = true;
        }

        if (last_name.value == '') {
            alert_last_name.textContent = 'Last name is required.';
            error = true;
        }
        if (last_name.value.length > 255) {
            alert_last_name.textContent = 'Last name must be 255 characters or less.';
            error = true;
        }

        if (error == false) {
            submit.form.submit();
        }
    }, false);

</script>