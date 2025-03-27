document.addEventListener("DOMContentLoaded", () => {
    // DOM elements and initial setup remains the same
    
    // Chat state
    let currentSession = null;
    let isOpen = false;
    let pollingInterval = null;

    // Get or create session when chat opens
    chatIcon.addEventListener("click", async () => {
        isOpen = !isOpen;
        if (isOpen) {
            chatWindow.classList.remove("hidden");
            unreadBadge.classList.add("hidden");

            try {
                // Try to load existing session
                const sessionId = localStorage.getItem('chatSessionId');
                
                if (sessionId) {
                    currentSession = await ChatApi.getSession(sessionId);
                }

                // Create new session if none exists
                if (!currentSession) {
                    currentSession = await ChatApi.createSession();
                    localStorage.setItem('chatSessionId', currentSession.id);
                }

                // Mark as read when opening
                await ChatApi.markAsRead(currentSession.id);
                currentSession.unread_count = 0;

                renderMessages(currentSession.messages);
                startPolling();
            } catch (error) {
                console.error("Error initializing chat:", error);
                addSystemMessage("Chat service unavailable. Please refresh.");
            }
        }
    });

    // Send message implementation
    async function sendUserMessage() {
        const message = chatInput.value.trim();
        if (!message || !currentSession) return;

        try {
            // Clear input immediately
            chatInput.value = "";
            
            // Add temporary message
            const tempMessage = {
                id: `temp-${Date.now()}`,
                content: message,
                sender_type: "user",
                created_at: new Date().toISOString()
            };
            addMessage(tempMessage);

            // Send to server
            const confirmedMessage = await ChatApi.sendUserMessage(
                currentSession.id, 
                message
            );

            // Replace temporary message with confirmed one
            const tempElement = document.querySelector(`[data-message-id="${tempMessage.id}"]`);
            if (tempElement) {
                tempElement.dataset.messageId = confirmedMessage.id;
                const timeSpan = tempElement.querySelector('.message-time');
                if (timeSpan) {
                    timeSpan.textContent = formatTime(new Date(confirmedMessage.created_at));
                }
            }
        } catch (error) {
            addSystemMessage("Failed to send message. Please try again.");
        }
    }

    // Polling implementation
    function startPolling() {
        pollingInterval = setInterval(async () => {
            if (!currentSession || !isOpen) return;

            try {
                const updatedSession = await ChatApi.getSession(currentSession.id);
                
                // Handle new messages
                if (updatedSession.messages.length > currentSession.messages.length) {
                    const newMessages = updatedSession.messages.slice(
                        currentSession.messages.length
                    );
                    
                    newMessages.forEach(msg => addMessage(msg));
                    currentSession = updatedSession;
                }

                // Update unread count
                if (!isOpen && updatedSession.unread_count > 0) {
                    unreadBadge.textContent = updatedSession.unread_count;
                    unreadBadge.classList.remove("hidden");
                }
            } catch (error) {
                console.error("Polling error:", error);
            }
        }, 3000); // Poll every 3 seconds
    }

    // Rest of the code remains similar (message rendering, helpers, etc.)
});