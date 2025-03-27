document.addEventListener("DOMContentLoaded", () => {
    // Get DOM elements
    const chatList = document.getElementById("chat-list")
    const chatMessages = document.getElementById("chat-messages")
    const chatInput = document.getElementById("admin-chat-input")
    const sendButton = document.getElementById("admin-send-message")
    const searchInput = document.getElementById("search-chats")
    const filterButtons = document.querySelectorAll(".filter-button")
    const noSelectedChat = document.getElementById("no-selected-chat")
    const selectedChatArea = document.getElementById("selected-chat-area")
  
    // Chat state
    let selectedChatId = null
    let currentFilter = "all"
    let pollingInterval = null
  
    // Chat API (assuming it's globally available or imported)
    // If it's a module, you might need to import it like:
    // import ChatApi from './chat-api';
    // For this example, I'm assuming it's globally available.
    const ChatApi = window.ChatApi // Or however you access it
  
    // Initialize
    init()
  
    // Event listeners
    searchInput.addEventListener("input", () => {
      loadChatSessions()
    })
  
    filterButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const filter = this.dataset.filter
        setActiveFilter(filter)
        loadChatSessions()
      })
    })
  
    sendButton.addEventListener("click", sendAdminMessage)
  
    chatInput.addEventListener("keydown", (e) => {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault()
        sendAdminMessage()
      }
    })
  
    // Functions
    async function init() {
      try {
        await loadChatSessions()
        startPolling()
      } catch (error) {
        console.error("Error initializing admin chat:", error)
      }
    }
  
    async function loadChatSessions() {
      try {
        const filters = {
          status: currentFilter !== "all" ? currentFilter : null,
          search: searchInput.value.trim() || null,
        }
  
        const response = await ChatApi.getSessions(filters)
  
        renderChatList(response.data || [])
      } catch (error) {
        console.error("Error loading chat sessions:", error)
      }
    }
  
    function renderChatList(sessions) {
      // Clear chat list
      chatList.innerHTML = ""
  
      // Render sessions
      if (sessions.length === 0) {
        chatList.innerHTML = '<div class="no-chats">No chat sessions found</div>'
      } else {
        sessions.forEach((session) => {
          const chatItem = document.createElement("div")
          chatItem.className = `chat-item ${selectedChatId === session.id ? "selected" : ""}`
          chatItem.dataset.id = session.id
  
          const statusClass = session.status === "active" ? "active" : session.status === "waiting" ? "waiting" : "closed"
  
          chatItem.innerHTML = `
                      <div class="chat-item-header">
                          <div class="chat-user">
                              <div class="user-avatar">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                              </div>
                              <div class="user-info">
                                  <h3>${escapeHtml(session.user.name)}</h3>
                                  <p>${escapeHtml(session.user.email)}</p>
                              </div>
                          </div>
                          <div class="chat-meta">
                              <span class="chat-time">${formatTime(new Date(session.last_activity_at))}</span>
                              ${session.unread_count > 0 ? `<span class="unread-count">${session.unread_count}</span>` : ""}
                          </div>
                      </div>
                      <p class="chat-preview">${escapeHtml(session.last_message || "No messages yet")}</p>
                      <div class="chat-status">
                          <span class="status-badge ${statusClass}">${capitalizeFirstLetter(session.status)}</span>
                      </div>
                  `
  
          chatItem.addEventListener("click", () => {
            selectChat(session.id)
          })
  
          chatList.appendChild(chatItem)
        })
      }
    }
  
    async function selectChat(chatId) {
      try {
        // Update selected chat
        selectedChatId = chatId
  
        // Update UI
        document.querySelectorAll(".chat-item").forEach((item) => {
          item.classList.remove("selected")
        })
  
        const selectedItem = document.querySelector(`.chat-item[data-id="${chatId}"]`)
        if (selectedItem) {
          selectedItem.classList.add("selected")
        }
  
        // Show chat area and hide placeholder
        noSelectedChat.classList.add("hidden")
        selectedChatArea.classList.remove("hidden")
  
        // Load chat messages
        const response = await ChatApi.getMessages(chatId)
  
        // Update chat header
        updateChatHeader(response.session)
  
        // Render messages
        renderMessages(response.messages || [])
  
        // Refresh chat list to update unread count
        loadChatSessions()
      } catch (error) {
        console.error("Error selecting chat:", error)
      }
    }
  
    function updateChatHeader(session) {
      const chatHeader = document.getElementById("selected-chat-header")
  
      if (!session) return
  
      const statusClass = session.status === "active" ? "active" : session.status === "waiting" ? "waiting" : "closed"
  
      const statusText = session.status === "active" ? "Online" : session.status === "waiting" ? "Waiting" : "Offline"
  
      chatHeader.innerHTML = `
              <div class="selected-user">
                  <div class="user-avatar">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                  </div>
                  <div class="user-info">
                      <h3>${escapeHtml(session.user.name)}</h3>
                      <div class="user-status">
                          <span class="status-dot ${statusClass}"></span>
                          <span>${statusText}</span>
                      </div>
                  </div>
              </div>
              <div class="chat-actions">
                  <select id="status-select" class="status-select">
                      <option value="active" ${session.status === "active" ? "selected" : ""}>Active</option>
                      <option value="waiting" ${session.status === "waiting" ? "selected" : ""}>Waiting</option>
                      <option value="closed" ${session.status === "closed" ? "selected" : ""}>Closed</option>
                  </select>
              </div>
          `
  
      // Add event listener to status select
      document.getElementById("status-select").addEventListener("change", async function () {
        try {
          await ChatApi.updateSessionStatus(session.id, this.value)
          loadChatSessions()
        } catch (error) {
          console.error("Error updating session status:", error)
        }
      })
    }
  
    function renderMessages(messages) {
      chatMessages.innerHTML = ""
  
      if (messages.length === 0) {
        chatMessages.innerHTML = '<p class="no-messages">No messages yet</p>'
        return
      }
  
      messages.forEach((message) => {
        const messageDiv = document.createElement("div")
        messageDiv.className = `message ${message.sender_type}`
  
        messageDiv.innerHTML = `
                  <div class="message-content">
                      <p>${escapeHtml(message.content)}</p>
                      <span class="message-time">${formatTime(new Date(message.created_at))}</span>
                  </div>
              `
  
        chatMessages.appendChild(messageDiv)
      })
  
      // Scroll to bottom
      chatMessages.scrollTop = chatMessages.scrollHeight
    }
  
    async function sendAdminMessage() {
      if (!selectedChatId) return
  
      const message = chatInput.value.trim()
      if (message === "") return
  
      try {
        // Clear input
        chatInput.value = ""
  
        // Send message to server
        await ChatApi.sendStaffMessage(selectedChatId, message)
  
        // Reload messages
        const response = await ChatApi.getMessages(selectedChatId)
        renderMessages(response.messages || [])
      } catch (error) {
        console.error("Error sending admin message:", error)
      }
    }
  
    function setActiveFilter(filter) {
      currentFilter = filter
  
      // Update active filter button
      filterButtons.forEach((button) => {
        button.classList.remove("active")
        if (button.dataset.filter === filter) {
          button.classList.add("active")
        }
      })
    }
  
    function startPolling() {
      if (pollingInterval) {
        clearInterval(pollingInterval)
      }
  
      pollingInterval = setInterval(async () => {
        // Refresh chat list
        await loadChatSessions()
  
        // If a chat is selected, refresh its messages
        if (selectedChatId) {
          try {
            const response = await ChatApi.getMessages(selectedChatId)
            renderMessages(response.messages || [])
          } catch (error) {
            console.error("Error refreshing messages:", error)
          }
        }
      }, 10000) // Poll every 10 seconds
    }
  
    // Helper functions
    function formatTime(date) {
      const now = new Date()
      const diffMs = now.getTime() - date.getTime()
      const diffMins = Math.floor(diffMs / 60000)
  
      if (diffMins < 1) return "Just now"
      if (diffMins < 60) return `${diffMins}m ago`
      if (diffMins < 1440) return `${Math.floor(diffMins / 60)}h ago`
      return date.toLocaleDateString()
    }
  
    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1)
    }
  
    function escapeHtml(unsafe) {
      if (!unsafe) return ""
      return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;")
    }
  })
  
  