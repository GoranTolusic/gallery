<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')

<body>
    <div id="confirmBox" class="confirm-box">
        <p>Are you sure?</p>
        <button id="confirmYes" onclick="confirmYes()">Yes</button>
        <button id="confirmNo" onclick="confirmNo()">No</button>
    </div>
    @include('layouts.partials.header')
    <main class="content">
        <section class="services-section">
            @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span><br><br>
            @endif
            @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span><br>
            @endif
            @if ($errors->has('main_picture'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('main_picture') }}</strong>
            </span><br>
            @endif
            @if ($errors->has('order'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('order') }}</strong>
            </span><br>
            @endif


            <div class="contact-container">
                <div class="form-group">
                    <button class="show-button" onclick="addForm()" id="showAdd">Add new Picture. Click here to expand the form</button>
                </div>
                <div hidden id="addForm">
                    <form action="/admin/addImage" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" required placeholder="Enter your title here" value="">
                        </div>


                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" rows="3">Description...</textarea>
                        </div>

                        <div class="form-group">
                            <label for="order">Order:</label>
                            <input type="number" id="order" name="order" required placeholder="Enter your order here" value="">
                        </div>


                        <div class="form-group">
                            <label for="main_picture">Picture:</label>
                        </div>
                        <div id="image-preview">
                            <img id="preview" src="" alt="Preview">
                        </div>
                        <div class="form-group">
                            <input type="file" id="image-upload-profile" name="main_picture" accept="image/*" onchange="previewImage(event, 'preview')">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add">
                        </div>
                    </form>
                </div>
            </div>


            <h2>Images Panel</h2>
            <div class="search-container">
                <form action="/admin/imagesPanel" method="GET" class="search-form">
                    <input type="text" name="keyword" class="search-input" placeholder="Search..." value="{{getHiddenParams('keyword')}}">
                    <button type="submit" class="search-btn"></button>
                </form>
            </div>

            @foreach($pictures as $picture)
            <div class="contact-container">

                <form action="/admin/editImage/{{$picture->id}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="submit" value="Update">
                        <button class="delete-button" onclick="deleteAction('{{$picture->id}}')">Delete</button>
                        <button class="information-button" onclick="information('{{$picture->id}}')" id="show-{{$picture->id}}">Show Information</button>

                    </div>

                    <div hidden id="hidden-{{$picture->id}}">
                        <span><strong>Created: </strong>{{$picture->created_at}}</span><br><br>
                        <span><strong>Updated: </strong>{{$picture->updated_at}}</span><br><br>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" id="title-{{$picture->id}}" name="title" required placeholder="Enter your title here" value="{{$picture->title}}">
                        </div>


                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description-{{$picture->id}}" name="description" rows="3">{{$picture->description}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="order">Order:</label>
                            <input type="number" id="order-{{$picture->id}}" name="order" required placeholder="Enter your order here" value="{{$picture->order}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="main_picture">Picture:</label>
                    </div>
                    <div id="image-preview">
                        <img id="preview{{$picture->id}}" src="/thumbnails/{{$picture->url_path}}" alt="Preview">
                    </div>
                    <div class="form-group">
                        <input type="file" id="image-upload-profile" name="main_picture" accept="image/*" onchange="previewImage(event, 'preview{{$picture->id}}')">
                    </div>

                </form>
            </div>
            @endforeach
        </section>
    </main>

    <div class="pagination-container">
        {{ $pictures->links() }}
    </div>
    <br>

    <script>
        const confirmBox = document.getElementById('confirmBox');
        let deleteId;

        function previewImage(event, preview) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const imagePreview = document.getElementById(preview);
                imagePreview.src = reader.result;
            }
            reader.readAsDataURL(input.files[0]);
        }

        async function deleteImage(id) {
            var resp = await fetch('/admin/deleteImage/' + id, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: 'DELETE'
            })
            var data = await resp.json();
            if (data == 200) location.reload()
        }

        function deleteAction(id) {
            event.preventDefault();
            deleteId = id;
            confirmBox.style.display = 'block';
        }

        function confirmYes() {
            deleteImage(deleteId)
            confirmBox.style.display = 'none';
        }

        function confirmNo() {
            confirmBox.style.display = 'none';
        }

        function information(id) {
            event.preventDefault();
            var getHidden = document.getElementById('hidden-' + id);
            var getShow = document.getElementById('show-' + id);
            if (getHidden.hasAttribute('hidden')) {
                getHidden.removeAttribute('hidden');
                getShow.textContent = 'Hide Information';
            } else {
                getShow.textContent = 'Show Information';
                getHidden.setAttribute('hidden', '');
            }
        }

        function addForm() {
            event.preventDefault();
            var getHidden = document.getElementById('addForm');
            var getShow = document.getElementById('showAdd');
            if (getHidden.hasAttribute('hidden')) {
                getHidden.removeAttribute('hidden');
                getShow.textContent = 'Add new Picture. Click here to hide the form';
            } else {
                getShow.textContent = 'Add new Picture. Click here to expand the form';
                getHidden.setAttribute('hidden', '');
            }
        }
    </script>
    @include('layouts.partials.footer')
</body>

</html>