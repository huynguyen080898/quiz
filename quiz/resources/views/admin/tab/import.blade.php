<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" onclick="enableFileTab()" href="#importByFile">them cau hoi tu file</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" onclick="enableTableTab()" href="#importByTable">them cau hoi tu ngan hang cau hoi</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div id="importByFile" class="container tab-pane active"><br>
        <div class="custom-file">
            <input type="file" class="custom-file-input importByFile" name="fileImport" required>
            <label class="custom-file-label">Choose file</label>
        </div>
    </div>
    <div id="importByTable" class="container tab-pane fade"><br>
        TEST
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Nhập tên de thi..." disabled="disabled">
        </div>
    </div>
</div>