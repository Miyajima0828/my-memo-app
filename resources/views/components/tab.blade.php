    <div class="tabs">
        <input id="all" type="radio" name="tab_item" checked>
        <label class="tab_item" for="all">総合</label>
        <input id="programming" type="radio" name="tab_item">
        <label class="tab_item" for="programming">プログラミング</label>
        <input id="design" type="radio" name="tab_item">
        <label class="tab_item" for="design">デザイン</label>
        <div class="tab_content" id="all_content">
            <div class="tab_content_description">
                <p class="c-txtsp">
                    <x-texts />
                </p>
            </div>
        </div>
        <div class="tab_content" id="programming_content">
            <div class="tab_content_description">
                <p class="c-txtsp">
                    <x-texts />

                </p>
            </div>
        </div>
        <div class="tab_content" id="design_content">
            <div class="tab_content_description">
                <p class="c-txtsp">
                    <x-texts />

                </p>
            </div>
        </div>
    </div>