<div class="d-flex">
    <div class="me-2">
        <a href="{{ route('admin.question.edit',$row->id) }}" class="btn btn-info">edit</a>
    </div>
    <div class="me-2">
        <a href="{{ route('admin.question.show',$row->id) }}" class="btn btn-success">Lihat</a>
    </div>
    <div>
        <form action="{{ route('admin.question.destroy',$row->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
        </form>
    </div>
</div>
