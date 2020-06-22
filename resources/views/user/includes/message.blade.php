<!-- SweetAlert2 -->
<script src="{{asset('adminpanel/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('adminpanel/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });
        @if(Session::has('success'))
        $(document).Toasts('create', {
            class: 'bg-success', 
            title: 'Success',
            subtitle: '',
            body: "{{ Session::get('success') }}"
        });
        @endif
        @if(Session::has('error'))
        $(document).Toasts('create', {
            class: 'bg-danger', 
            title: 'Error',
            subtitle: '',
            body: "{{ Session::get('error') }}"
        });
        @endif
        @if(count($errors)>0)
        @foreach($errors->all() as $error)
        $(document).Toasts('create', {
            class: 'bg-danger', 
            title: 'Error',
            subtitle: '',
            body: "{{ $error }}"
        });
        @endforeach
        @endif
        @if(Session::has('info'))
        $(document).Toasts('create', {
            class: 'bg-info', 
            title: 'Info',
            subtitle: '',
            body: "{{ Session::get('info') }}"
        });
        @endif
    });
</script>
