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
            <h2>Messages</h2>
            <div class="search-container">
                <form action="/admin/messages" method="GET" class="search-form">
                    <input type="text" name="keyword" class="search-input" placeholder="Search..." value="{{getHiddenParams('keyword')}}">
                    <button type="submit" class="search-btn"></button>
                </form>
            </div>

            @foreach($messages as $message)
            <div class="contact-container">
                <form action="/admin/deleteMessage/{{$message->id}}" method="post">
                    @csrf
                    <div class="form-group">
                        <button class="delete-button" onclick="deleteAction('{{$message->id}}')">Delete</button>
                        <button class="information-button" onclick="information('{{$message->id}}')" id="show-{{$message->id}}">Show Information</button>
                        <strong>Subject:</strong> {{$message->name}}
                        <span style="color:red;" id="read-{{$message->id}}" read="{{$message->isRead}}">
                            @if($message->isRead == 'no')
                            (Unread)
                            @endif
                        </span>

                    </div>

                    <div hidden id="hidden-{{$message->id}}">
                        <div class="form-group">
                            <label for="title">Email: </label> {{$message->email}}
                        </div>
                        <div class="form-group">
                            <label for="title">Sent: </label> {{$message->created_at}}
                        </div>
                        <div class="form-group">
                            <label for="description">Message:</label>
                            <p>{{nl2br($message->message)}}</p>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </section>
    </main>

    <div class="pagination-container">
        {{ $messages->links() }}
    </div>
    <br>

    <script>
        const confirmBox = document.getElementById('confirmBox');
        let deleteId;

        async function readMessage(id) {
            var resp = await fetch('/admin/readMessage/' + id, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: 'POST'
            })
            var data = await resp.json();
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

            var isReadEl = document.getElementById('read-' + id)
            var isRead = isReadEl.getAttribute('read')
            if (isRead == 'no') {
                isReadEl.textContent = ''
                isReadEl.setAttribute('read', 'yes')
                readMessage(id)
            }
        }

        function deleteAction(id) {
            event.preventDefault();
            deleteId = id;
            confirmBox.style.display = 'block';
        }

        function confirmYes() {
            deleteMessage(deleteId)
            confirmBox.style.display = 'none';
        }

        function confirmNo() {
            confirmBox.style.display = 'none';
        }

        async function deleteMessage(id) {
            var resp = await fetch('/admin/deleteMessage/' + id, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: 'POST'
            })
            var data = await resp.json();
            if (data == 200) location.reload()
        }
    </script>
    @include('layouts.partials.footer')
</body>

</html>