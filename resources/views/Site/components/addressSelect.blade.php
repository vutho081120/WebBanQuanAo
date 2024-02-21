<!-- Login -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:860px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thay đổi địa chỉ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container" style="padding: 0">
                <div class="d-flex justify-content-center h-100">
                    <div class="card col-md-12">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col"> Người nhận </th>
                                        <th scope="col"> Số điện thoại </th>
                                        <th scope="col"> Địa chỉ </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($diachiList) && count($diachiList) > 0)
                                        @foreach ($diachiList as $key => $value)
                                            <tr class="table-row" data-href="{{ route('site.address.select', $value->id) }}" style="cursor: pointer">
                                                <td class="w-25">
                                                    {{ $value->recipien_name }}
                                                </td>
                                                <td>
                                                    {{ $value->phone }}
                                                </td>
                                                <td>
                                                    {{ $value->address.', '.$phuong->getWardName($value->phuong_id).', '.
                                                    $huyen->getDistrictName($value->huyen_id).', '.$tinh->getProvinceName($value->tinh_id) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7"> Chưa có địa chỉ phụ nào </td>
                                        </tr>    
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- End Login -->