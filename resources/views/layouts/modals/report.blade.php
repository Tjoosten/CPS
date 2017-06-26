<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Report comment</h4>
            </div>
            <div class="modal-body">
                <form action="" id="form">
                    {{ csrf_field() }} {{-- CSRF token form protection --}}
                    <input type="hidden" value="" name="id">

                    <p>Please report anything you are offended with of content that is against our community guidelines.</p>

                    <fieldset>
                        <legend>Reasons:</legend>

                        <div class="form-group">
                            @foreach($reportReasons as $reason)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="{{ $reason->id }}">
                                        {{ $reason->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Extra information:</legend>

                        <div class="form-group">
                            <textarea style="resize: none;" class="form-control" rows="6" name="description" placeholder="Please document why u reporting this."></textarea>
                        </div>
                    </fieldset>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" form="form">
                    <span class="fa fa-check" aria-hidden="true"></span> Report
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <span class="fa fa-close" aria-hidden="true"></span> Close
                </button>
            </div>
        </div>
    </div>
</div>