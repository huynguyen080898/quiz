<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" onclick="enableFileTab()" href="#importByFile">Thêm câu hỏi từ
            file</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" onclick="enableTableTab()" href="#importByTable">Thêm câu hỏi từ ngân hàng
            câu hỏi</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div id="importByFile" class="container tab-pane active"><br>
        <div class="custom-file">
            <input type="file" class="custom-file-input importByFile" name="fileImport">
            <label class="custom-file-label">Choose file</label>
        </div>
    </div>
    <div id="importByTable" class="container tab-pane fade"><br>

    </div>
</div>