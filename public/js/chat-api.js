/**
 * Chat API Service - Real implementation
 */
const ChatApi = {
  /**
   * Get existing chat session
   * @param {number} sessionId - The chat session ID
   * @returns {Promise} Promise object with session data
   */
  getSession: async (sessionId) => {
      try {
          const response = await fetch(`/chat/sessions/${sessionId}`);
          
          if (!response.ok) {
              const errorText = await response.text();
              console.error("Failed to fetch session:", errorText);
              return null;
          }
          
          return await response.json();
      } catch (error) {
          console.error("Error fetching session:", error);
          return null;
      }
  },

  /**
   * Create new session (existing implementation)
   */
  createSession: async () => {
      // Keep existing implementation
  },

  /**
   * Send message (existing implementation)
   */
  sendUserMessage: async (sessionId, content) => {
      // Keep existing implementation
  },

  /**
   * Mark session as read
   * @param {number} sessionId - The chat session ID
   */
  markAsRead: async (sessionId) => {
      try {
          const csrfToken = document.querySelector('meta[name="csrf-token"]');
          const response = await fetch(`/chat/sessions/${sessionId}/mark-as-read`, {
              method: 'PUT',
              headers: {
                  'X-CSRF-TOKEN': csrfToken.content,
                  'Content-Type': 'application/json',
              },
          });
          
          return await response.json();
      } catch (error) {
          console.error("Error marking as read:", error);
      }
  }
};