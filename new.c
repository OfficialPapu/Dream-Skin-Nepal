#include <stdio.h>
#ifdef _WIN32
#include <windows.h> // For Sleep() function
#else
#include <unistd.h>  // For usleep() function
#endif

#define BAR_WIDTH 50

void print_loading_bar(int progress, char spinner) {
    int completed = (progress * BAR_WIDTH) / 100;
    printf("[");
    for (int i = 0; i < BAR_WIDTH; i++) {
        if (i < completed) {
            printf("#");
        } else {
            printf(" ");
        }
    }
    printf("] %d%% %c\r", progress, spinner);
    fflush(stdout);
}

char get_spinner_char(int step) {
    const char spinner_chars[] = {'|', '/', '-', '\\'};
    return spinner_chars[step % 4];
}

int main() {
    printf("Loading game...\n");
    for (int i = 0; i <= 100; i++) {
        char spinner = get_spinner_char(i);
        print_loading_bar(i, spinner);
#ifdef _WIN32
        Sleep(50); // Sleep for 50 milliseconds
#else
        usleep(50000); // Sleep for 50 milliseconds
#endif
    }
    printf("\nGame loaded successfully!\n");
    return 0;
}
