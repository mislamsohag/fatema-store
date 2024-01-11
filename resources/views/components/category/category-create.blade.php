<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Category</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                <input id="categoryName" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                    aria-label="Close">Cancel</button>
                <button onclick="create()" id="save-btn" class="btn bg-gradient-success">Create</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function create() {
        const categoryName = document.getElementById('categoryName').value;
        if (categoryName.length === 0) {
            errorToast("Category Name is Required !")
        }
        else {
            document.getElementById('modal-close').click(); //modal close
            
            showLoader();
            let res = await axios.post("/category-create", {
                name: categoryName
            });
            hideLoader();
            
            if (res.status === 201) {
                successToast('Request completed');

                document.getElementById("save-form").reset(); //ফরম রিসেট

                await getList(); // এটা হলো mother layout এর function, এর মাধ্যমে ক্যাটাগরি তৈরির সাথে সাথে পুনরায় page টি রিলোড করানো হচ্ছে।
            }
            else {
                errorToast("Request fail !")
            }
        }
    }
</script>