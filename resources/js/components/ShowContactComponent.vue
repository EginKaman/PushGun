<template>
  <main>
    <div class="contact-table">
      <a class="contact-table__btn">Экспорт</a>
      <div v-for="item in 7" :key="item.id" class="contact-table__wrapper">
        <ul>
          <li>Email адрес</li>
          <li>Телефон</li>
          <li>Имя</li>
          <li>Дата добавления</li>
          <li @click="func(item)">...</li>
        </ul>
        <div v-if="showModal === item" class="contact-table__modal">
          <div @click="showModal = null" class="contact-table__modal__close">
            x
          </div>
        </div>
      </div>
      <div class="contact-table__pagination">
        <span class="active">1</span>
        <span>2</span>
        <span>3</span>
        <img src="../../images/right.svg" />
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data: () => ({
    showModal: null,
  }),
  methods: {
    func(item) {
      this.showModal = item;
    },
  },
};
</script>