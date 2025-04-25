import MicroModal from 'micromodal';

document.addEventListener('DOMContentLoaded', () => {
    MicroModal.init({
        openTrigger: 'data-auth-trigger',
        closeTrigger: 'data-micromodal-close',
        disableScroll: true,
        awaitOpenAnimation: false,
        awaitCloseAnimation: false,
        debugMode: false,
        onShow: () => document.body.classList.add('modal-open'),
        onClose: () => document.body.classList.remove('modal-open'),
        overlayClose: false
    });

    const authModalOverlay = document.querySelector('#auth-modal .modal__overlay');
    const authModalContainer = document.querySelector('#auth-modal .modal__container');
    const registerModalOverlay = document.querySelector('#register-modal .modal__overlay');
    const registerModalContainer = document.querySelector('#register-modal .modal__container');

    // Обработка клика вне auth
    authModalOverlay.addEventListener('click', (e) => {
        if (!authModalContainer.contains(e.target)) {
            MicroModal.close('auth-modal');
        }
    });

    // Обработка клика вне register
    registerModalOverlay.addEventListener('click', (e) => {
        if (!registerModalContainer.contains(e.target)) {
            MicroModal.close('register-modal');
        }
    });

    // Переключение между модалками
    document.getElementById('to-register').addEventListener('click', (e) => {
        e.preventDefault();
        MicroModal.close('auth-modal');
        setTimeout(() => MicroModal.show('register-modal'), 300);
    });

    document.getElementById('to-login').addEventListener('click', (e) => {
        e.preventDefault();
        MicroModal.close('register-modal');
        setTimeout(() => MicroModal.show('auth-modal'), 300);
    });
});
