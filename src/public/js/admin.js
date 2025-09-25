document.addEventListener('DOMContentLoaded', function () {
    const modalWrapper = document.getElementById('modal-detail');
    const detailButtons = document.querySelectorAll('.contacts-table__button'); // クラス名が一致するように修正
    const closeModalButton = document.querySelector('.modal__close-button');
    const deleteForm = document.getElementById('delete-form');
    
    detailButtons.forEach(button => {
        button.addEventListener('click', function () {
            // ボタンのdata属性からデータを取得
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const gender = this.getAttribute('data-gender');
            const email = this.getAttribute('data-email');
            const tel = this.getAttribute('data-tel');
            const address = this.getAttribute('data-address');
            const building = this.getAttribute('data-building');
            const category = this.getAttribute('data-category');
            const detail = this.getAttribute('data-detail');
            
            // モーダルにデータをセット
            document.getElementById('modal-name').textContent = name;
            document.getElementById('modal-gender').textContent = gender;
            document.getElementById('modal-email').textContent = email;
            document.getElementById('modal-tel').textContent = tel;
            document.getElementById('modal-address').textContent = address;
            document.getElementById('modal-building').textContent = building;
            document.getElementById('modal-category').textContent = category;
            document.getElementById('modal-detail-text').textContent = detail;
            
            // 削除フォームのアクションURLを動的に設定
            deleteForm.action = `/admin/${id}`;
            
            // モーダルを表示
            modalWrapper.style.display = 'flex';
        });
    });

    // モーダルを閉じる
    closeModalButton.addEventListener('click', function () {
        modalWrapper.style.display = 'none';
    });

    // モーダルの外側をクリックして閉じる
    modalWrapper.addEventListener('click', function (e) {
        if (e.target === modalWrapper) {
            modalWrapper.style.display = 'none';
        }
    });
});