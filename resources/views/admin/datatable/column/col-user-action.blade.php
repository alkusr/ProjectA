<div class="d-flex">
    <div>
        <form action="{{ route('admin.user.destroy', $row->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('apakah anda yakin ingin menghapus ?')" class="btn btn-danger">Hapus</button>
        </form>
    </div>
</div>
