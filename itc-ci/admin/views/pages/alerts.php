<?php
?>
<div class="tile-body" style="display: none ;">

    <div class="row">
        <div class="col-md-4">

            <div class="form-group">
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm" for="closeButton">
                    <input id="closeButton" type="checkbox" value="checked"><i></i> Close Button
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm" for="addBehaviorOnToastClick">
                    <input id="addBehaviorOnToastClick" type="checkbox" value="checked"><i></i> Add behavior on toast click
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm" for="debugInfo">
                    <input id="debugInfo" type="checkbox" value="checked"><i></i> Debug
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm" for="progressBar">
                    <input id="progressBar" type="checkbox" value="checked"><i></i> Progress Bar
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm" for="preventDuplicates">
                    <input id="preventDuplicates" type="checkbox" value="checked"><i></i> Prevent Duplicates
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm" for="addClear">
                    <input id="addClear" type="checkbox" value="checked"><i></i> Add button to force clearing a toast, ignoring focus
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm" for="newestOnTop">
                    <input id="newestOnTop" type="checkbox" value="checked"><i></i> Newest on top
                </label>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group" id="toastTypeGroup">
                <label>Toast Type</label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="toasts" value="success" checked /><i></i> Success
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="toasts" value="info" /><i></i> Info
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="toasts" value="warning" /><i></i> warning
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="toasts" value="error" /><i></i> Error
                </label>
            </div>
            <div class="form-group" id="positionGroup">
                <label>Position</label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="positions" value="toast-top-right" checked /><i></i> Top Right
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="positions" value="toast-bottom-right" /><i></i> Bottom Right
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="positions" value="toast-bottom-left" /><i></i> Bottom Left
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="positions" value="toast-top-left" /><i></i> Top Left
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="positions" value="toast-top-full-width"/><i></i> Top Full Width
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="positions" value="toast-bottom-full-width"/><i></i> Bottom Full Width
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="positions" value="toast-top-center"/><i></i> Top Center
                </label>
                <label class="checkbox checkbox-custom-alt checkbox-custom-sm">
                    <input type="radio" name="positions" value="toast-bottom-center"/><i></i> Bottom Center
                </label>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" for="showEasing">Show Easing</label>
                <input id="showEasing" type="text" placeholder="swing, linear" class="form-control" value="swing" />
            </div>

            <div class="form-group">
                <label class="control-label" for="hideEasing">Hide Easing</label>
                <input id="hideEasing" type="text" placeholder="swing, linear" class="form-control" value="linear" />
            </div>

            <div class="form-group">
                <label class="control-label" for="showMethod">Show Method</label>
                <input id="showMethod" type="text" placeholder="show, fadeIn, slideDown" class="form-control" value="fadeIn" />
            </div>

            <div class="form-group">
                <label class="control-label" for="hideMethod">Hide Method</label>
                <input id="hideMethod" type="text" placeholder="hide, fadeOut, slideUp" class="form-control" value="fadeOut" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="showDuration">Show Duration</label>
                <input id="showDuration" type="text" placeholder="ms" class="form-control" value="300" />
            </div>

            <div class="form-group">
                <label class="control-label" for="hideDuration">Hide Duration</label>
                <input id="hideDuration" type="text" placeholder="ms" class="form-control" value="1000" />
            </div>

            <div class="form-group">
                <label class="control-label" for="timeOut">Time out</label>
                <input id="timeOut" type="text" placeholder="ms" class="form-control" value="5000" />
            </div>

            <div class="form-group">
                <label class="control-label" for="extendedTimeOut">Extended time out</label>
                <input id="extendedTimeOut" type="text" placeholder="ms" class="form-control" value="1000" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" id="showtoast">Show Toast</button>
            <button type="button" class="btn btn-danger" id="cleartoasts">Clear Toasts</button>
            <button type="button" class="btn btn-danger" id="clearlasttoast">Clear Last Toast</button>
        </div>
    </div>

    <div class="row" style='margin-top: 25px;'>
        <div class="col-md-12">
            <pre id='toastrOptions'></pre>
        </div>
    </div>

</div>
