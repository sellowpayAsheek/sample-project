<div class="modal fade" id="statementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Check statement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="statementbody">
            <table class="table">
                <thead class="thead-dark">
                    <th scope="col">Status</th>
                    <th scope="col">Notes</th>
                    <th scope="col">ip address</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="$('#statementModal').modal('hide')" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
