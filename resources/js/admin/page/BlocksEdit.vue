<template>
    <div class="form-group border p-3 shadow mb-4" v-for="(block, index) in blocks" :key="index">
        <label :for="'block-' + index" class="form-label">Выберите блок</label>
        <select :id="'block-' + index" v-model="block.type" :name="'page.' + position + '[]'" class="form-control">
            <option value="null">Не показывать</option>
            <option :value="key" v-for="(type, key) in blockTypes" :key="key">
                {{ type }}
            </option>
        </select>
        <div v-if="block.type === 'text'" class="mt-2">
            <textarea class="form-control" rows="5" v-model="block.content"></textarea>
        </div>
        <img v-if="block.type !== 'null' && block.type !== 'text'" :src="'/img/admin/forms/' + block.type + '.jpg'" style="width: 100%;" class="mt-3" alt="">
        <button class="btn btn-default mt-3 float-end" type="button" @click="removeBlock(index)">Удалить блок</button>
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-default" @click="addBlock" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="me-2" viewBox="0 0 16 16" role="img" path="bs.plus-circle" componentname="orchid-icon">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
            </svg>
            <span>Добавить блок</span>
        </button>
    </div>
    <textarea :name="'blocks[' + position + ']'" hidden="hidden" v-html="JSON.stringify(blocks)" id="" cols="30" rows="10"></textarea>
</template>

<script lang="ts">
import draggable from 'zhyswan-vuedraggable'

export default {
    components: {
        draggable
    },
    props: {
        position: {
            default: 'center'
        },
        defaultBlocks: {
            default: () => ([]),
        }
    },
    data() {
        return {
            blocks: [],
            blockTypes: {},
        }
    },
    mounted() {
        if (this.position === 'center') {
            this.blockTypes = {
                documents: 'Документы',
                download: 'Загрузка',
                request: 'Заявка в AXO',
                fastNavigation: 'Быстрая навигация',
                advantages: 'Преимущества',
                createNewEmployee: 'Создать учетную запись сотрудника',
                idea: 'Бизнес идея',
                keyPersons: 'Ключевые лица компании',
                newEmployee: 'Welcome-Book и создание учетной записи (ссылка)',
                privilege: 'Привелегии',
                services: 'Услуги',
                structure: 'Структура компании',
                vacancies: 'Вакансии',
                text: 'Текстовый блок',
            }
        } else {
            this.blockTypes = {
                ourBlog: 'Наш блог',
                myBlog: 'Мой блог',
                birthdays: 'Дни рождений',
                text: 'Текстовый блок',
            }
        }

        if (this.defaultBlocks && this.defaultBlocks.length > 0) {
            this.blocks = this.defaultBlocks.map(block => ({
                type: block.type || 'null',
                content: block.content || ''
            }));
        }

        console.error(this.blocks)
    },
    methods: {
        addBlock() {
            this.blocks.push({ type: 'null', content: '' });
        },
        removeBlock(index) {
            this.blocks.splice(index, 1);
        }
    },
    watch: {
        blocks: {
            handler(val, oldVal) {
                console.warn(this.blocks)
            },
            deep: true,
        }
    }
}
</script>
