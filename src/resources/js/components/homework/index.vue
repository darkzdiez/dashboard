<template>
    <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
        <template v-if="state.display == 'list'">
            <div  class="dropdown-item" v-for="(record, key) in state.records" :key="key" @click="open(record.uuid)">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ record.title }}</h5>
                    <small>{{ record.created_at_ago }}</small>
                </div>
                <p class="mb-1" v-if="3==4">Some placeholder content in a paragraph.</p>
                <small>{{ record.user_name }}</small>
            </div>
        </template>
    </div>
</template>

<script>
import crudForm from './crud-form.vue'
export default {
    components: {
        'crud-form': crudForm
    },
    data() {
        return {
            endpoint: '',
            state: {
                display: 'loading'
            }
        }
    },
    created () {
        this.endpoint = window.apis.homework;
        axios.get(this.endpoint).then((response) => {
            this.state.records = response.data
            this.state.display = 'list'
        })
    },
    methods: {
        add() {
            this.state.display = 'add'
        },
        open(uuid) {
            this.$root.homeworkShow(uuid)
        }
    }
}
</script>
<style lang="scss" scoped>
    .dropdown-menu {
        width: 300px !important;
    }
    .dropdown-item {
        cursor: pointer;
        user-select: none;
    }
    h5 {
        font-weight: bold;
        font-size: 1rem;
    }
    .detail-modal {
        background-color: rgba($color: #000000, $alpha: .4);
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 9999;
        &__container {
            position: sticky;
            top: 50px;
            background-color: #ffffff;
            overflow: hidden;
        }
        &__body {
            border-bottom: 1px solid #cbc8d0;
            border-top: 1px solid #cbc8d0;
            margin-top: 9px;
            margin-bottom: 16px;
        }
        &__footer {
            margin-bottom: 1.5rem;
        }
        &__header {
            margin-top: 1rem;
            font-size: 20px;
            font-weight: 600;
        }
    }
</style>