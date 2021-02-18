<template>
  <main>
    <div v-for="item in items" :key="item.id">
      <div class="contact-block">
        <div class="contact-block__wrapper">
          <span>{{ item.data }}</span>
          <a>{{ item.name }}</a>
          <p>
            Подписчиков: <span>{{ item.count }}</span>
          </p>
        </div>
        <div class="contact-block__wrapper right">
          <div class="contact-block__wrapper__item">
            <p>{{ item.count }}</p>
            <span>e-mail</span>
          </div>
          <div class="contact-block__wrapper__item">
            <p>0</p>
            <span>телефонов</span>
          </div>
        </div>
      </div>
    </div>
    <div class="email-btn">
      <div class="button_green mr-24">
        <span class="green_button_circle"></span>
        <a @click="show = true" class="button_green_inner">
          <p class="button_text_container">
            <img src="../../images/book.svg" alt="" />Новая адресная книга
          </p>
        </a>
      </div>
    </div>
    <div v-if="show === true" class="contact-popup">
      <div v-click-outside="closePopup" class="contact-popup__block">
        <div @click="show = false" class="contact-popup__block__head">
          <p>Новая адресная книга</p>
          <img src="../../images/business-close.svg" alt="" />
        </div>
        <div class="contact-popup__block__sect">
          <p>Введите название</p>
          <input type="text" placeholder="Новый список 18" />
        </div>
        <div class="contact-popup__block__foot">
          <div class="button_green mr-24">
            <span class="green_button_circle"></span>
            <a :href="route('contact.create')"  class="button_green_inner">
              <p class="button_text_container"><img src="" alt="" />Добавить</p>
            </a>
          </div>
          <div style="backgorund: #fafafa" class="button_white">
            <span class="white_button_circle"></span>
            <a
              style="background: rgb(222 222 222 / 1)"
              class="button_white_inner"
            >
              <p class="button_text_container">
                <img class="button-img" src="" alt="" />Отмена
              </p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import vClickOutside from "v-click-outside";
export default {
  name: "Contact",
  directives: {
    clickOutside: vClickOutside.directive,
  },
  data: () => ({
    show: false,
    items: [
      {
        id: 1,
        data: "03.02.2021 15:00",
        name: "Название адресной книги",
        count: "9 568",
      },
      {
        id: 2,
        data: "03.02.2021 15:00",
        name: "Название адресной книги",
        count: "9 568",
      },
    ],
  }),
  methods: {
    closePopup() {
      this.show = false;
    },
  },
};
</script>