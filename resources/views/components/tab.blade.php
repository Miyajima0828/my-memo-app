<div class="tabs">
    <form action="#" method="POST">

        <input id="tab1" type="radio" name="tab_item" checked>
        <label class="tab_item" for="all">総合</label>
        <input id="tab2" type="radio" name="tab_item">
        <label class="tab_item" for="programming">プログラミング</label>
        <input id="tab3" type="radio" name="tab_item">
        <label class="tab_item" for="design">デザイン</label>
        <input id="tab4" type="radio" name="tab_item">
        <label class="tab_item" for="test">テスト</label>
        <input id="tab5" type="radio" name="tab_item">
        <label class="tab_item" for="document">書類</label>
        <div class="tab_content" id="all_content">
            <div class="tab_content_description">
                <textarea style="height:80vh;" class="w-full border-none" name="text"></textarea>
            </div>
        </div>
        <div class="tab_content" id="programming_content">
            <div class="tab_content_description">
                <p class="c-txtsp">プログラミングの内容がここに入ります</p>
            </div>
        </div>
        <div class="tab_content" id="design_content">
            <div class="tab_content_description">
                <p class="c-txtsp">デザインの内容がここに入ります</p>
            </div>
        </div>
        <div class="tab_content" id="test_content">
            <div class="tab_content_description">
                <p class="c-txtsp">テストの内容がここに入ります</p>
            </div>
        </div>
        <div class="tab_content" id="document_content">
            <div class="tab_content_description">
                <p class="c-txtsp">書類の内容がここに入ります</p>
            </div>
        </div>
    </form>
</div>