<template>
  <main>
    <div class="addContact">
      <div class="addContact__head">
        <a @click="show = false" :class="{ active: show === false }"
          >Загрузить файл</a
        >
        <a @click="show = true" :class="{ active: show === true }"
          >Добавить вручную</a
        >
      </div>
      <div v-if="show === false" class="addContact__wrapper">
        <div class="addContact__wrapper__item">
          <div>
            <p>Файл для загрузки:</p>
          </div>
          <div>
            <span>Поддерживаемые форматы: TXT, CSV, XLS, XLSX</span>
            <label>
              <input class="file" type="file" />
              <p><img src="../../images/plusik.svg" />Добавить файл</p>
            </label>
          </div>
        </div>
      </div>
      <div v-else class="addContact__wrapper">
        <div class="addContact__wrapper__item">
          <div>
            <p>Список контактов:</p>
          </div>
          <div>
            <span>Можно ввести не более 1 000 контактов. Разделить между адресами - перенос строки</span>
            <label>
              <textarea name="" id="" cols="30" rows="10" placeholder="@pushgun"></textarea>
            </label>
          </div>
        </div>
      </div>
      <div class="button_green mr-24">
        <span class="green_button_circle"></span>
        <a :href="route('contact.create')" class="button_green_inner">
          <p class="button_text_container"><img src="" alt="" />Добавить</p>
        </a>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data: () => ({
    show: false,
  }),
};
</script>