{{-- selec2 cdn --}}

<div class="modal fade" id="searchModal" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <form method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">On-demand search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="nameVi">Categories</label>
                                <select class=" form-control" name="category_id" multiple="multiple"  id="category_id" style="width: 470px">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Price range
                                </label>
                                <input type="number" value="{{ old('startPrice') }}" class="form-control"
                                    name="startPrice" id="startPrice" placeholder="$ Từ">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="name">.</label>
                                <input type="text" value="{{ old('endPrice') }}" class="form-control" name="endPrice"
                                    id="endPrice" placeholder="$ Đến">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="quantity">Time range
                                </label>
                                <input type="date" name="start_date" placeholder="dd/mm/yyyy"
                                    class="form-control start_date" value=""
                                    min="{{ Carbon\Carbon::now()->firstOfYear()->format('d-m-Y') }}"
                                    max="{{ Carbon\Carbon::now()->lastOfYear()->format('d-m-Y') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="quantity">.</label>
                                <input type="date" class="form-control" name="end_date" placeholder="dd/mm/yyyy"
                                    class="form-control end_date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <p><b>Status:</b></p>
                                <input type="radio" id="html" checked name="status" value="0">
                                <label for="html">Hide </label><br>
                                <input type="radio" id="css" checked name="status" value="1">
                                <label for="css">Show</label><br>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
            // Select2 Multiple
            $('#category_id').select2({
                dropdownParent: $('#searchModal')
            });
        });
</script>
