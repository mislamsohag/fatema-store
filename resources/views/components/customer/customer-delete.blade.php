<div id="delete-modal" class="modal animated zoomIn">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-Danger">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input id="deleteID" class="d-none"/>

            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button id="delete-modal-close" type="button" class="btn mx-2 bg-gradient-primary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete" class="btn  bg-gradient-danger" >Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     async  function  itemDelete(){
            let id=document.getElementById('deleteID').value;
            document.getElementById('delete-modal-close').click();
            showLoader();
            let res=await axios.post("/customer-delete",{id:id})
            hideLoader();
            if(res.data===1){
                successToast("Request completed")
                await getList();
            }
            else{
                errorToast("Request fail!")
            }
     }
</script>
