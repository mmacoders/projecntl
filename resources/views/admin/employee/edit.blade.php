<form action="{{ route('employee.edit') }}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
      <div class="col-lg-12">
        <div class="mb-3">
          <label class="form-label">ID Karyawan</label>
          <input type="text" class="form-control" name="id_employee" value="{{ $employee->id_employee }}" readonly>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" name="username" value="{{ $employee->username }}">
        </div>
      </div>
      <div class="col-lg-12">
        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" name="fullname" value="{{ $employee->fullname }}">
        </div>
      </div>
      <div class="col-lg-12">
        <div class="mb-3">
          <label class="form-label">Jabatan</label>
          <input type="text" class="form-control" name="position" value="{{ $employee->jabatan }}">
        </div>
      </div>
      <div class="col-lg-12">
        <div class="mb-3">
          <div class="form-label">Jenis kelamin</div>
          <select class="form-select" name="gender" id="gender">
            @if ($employee->gender == 'l')
                <option value="l" selected>Laki-Laki</option>
            @else
            <option value="p">Perempuan</option>
            @endif
          </select>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="mb-3">
          <div class="form-label">Foto</div>
            <input type="file" name="photo" class="form-control" accept=".png, .jpg, .jpeg" />
        <input type="hidden" name="old_photo" value="{{ $employee->photo }}">
        </div>
      </div>
      <div class="col-lg-12">
        <button class="btn btn-primary w-100">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
          Simpan
        </button>
      </div>
    </div>
</form>