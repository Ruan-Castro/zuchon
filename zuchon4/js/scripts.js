const Modal = {
    open(){
        // Abrir modal
        // Adicionar a class active ao modal
        document
            .querySelector('.modal-overlay')
            .classList
            .add('active')

    },
    close(){
        // fechar o modal
        // remover a class active do modal
        document
            .querySelector('.modal-overlay')
            .classList
            .remove('active')
    }
}

const Form = {
    resumo: document.querySelector('input#resumo'),
    solicitacao: document.querySelector('input#solicitacao'),

    getValues() {
        return {
            resumo: Form.resumo.value,
            solicitacao: Form.solicitacao.value
        }
    },

    validateFields() {
        const { resumo, solicitacao, date } = Form.getValues()
        
        if( resumo.trim() === "" || 
            solicitacao.trim() === "" ) {
                throw new Error("Por favor, preencha todos os campos")
        }
    },

    formatValues() {
        let { resumo, solicitacao } = Form.getValues()
        
        solicitacao = Utils.formatsolicitacao(solicitacao)

        return {
            resumo,
            solicitacao
        }
    },

    clearFields() {
        Form.resumo.value = ""
        Form.solicitacao.value = ""
    },

    submit(event) {
        event.preventDefault()

        try {
            Form.validateFields()
            const resumo = Form.formatValues()
            resumo.add(resumo)
            Form.clearFields()
            Modal.close()
        } catch (error) {
            alert(error.message)
        }
    }
}

const App = {
    init() {
        resumo.all.forEach(DOM.addresumo)
        
        DOM.updateBalance()

        Storage.set(resumo.all)
    },
    reload() {
        DOM.clearresumos()
        App.init()
    },
}

App.init()